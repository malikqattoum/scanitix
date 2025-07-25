<?php
/*
 * @copyright Copyright (c) 2024 AltumCode (https://altumcode.com/)
 *
 * This software is exclusively sold through https://altumcode.com/ by the AltumCode author.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://altumcode.com/.
 */

namespace Altum\Controllers;

use Altum\Alerts;

class AdminLinks extends Controller {

    public function index() {

        /* Prepare the filtering system */
        $filters = (new \Altum\Filters(['is_enabled', 'user_id', 'domain_id', 'project_id'], ['url', 'location_url'], ['link_id', 'last_datetime', 'datetime', 'url', 'location_url', 'pageviews']));
        $filters->set_default_order_by($this->user->preferences->links_default_order_by, $this->user->preferences->default_order_type ?? settings()->main->default_order_type);
        $filters->set_default_results_per_page($this->user->preferences->default_results_per_page ?? settings()->main->default_results_per_page);

        /* Prepare the paginator */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `links` WHERE 1 = 1 {$filters->get_sql_where()}")->fetch_object()->total ?? 0;
        $paginator = (new \Altum\Paginator($total_rows, $filters->get_results_per_page(), $_GET['page'] ?? 1, url('admin/links?' . $filters->get_get() . '&page=%d')));

        /* Get the data */
        $links = [];
        $links_result = database()->query("
            SELECT
                `links`.*, `users`.`name` AS `user_name`, `users`.`email` AS `user_email`, `domains`.`scheme`, `domains`.`host`
            FROM
                `links`
            LEFT JOIN
                `users` ON `links`.`user_id` = `users`.`user_id`
            LEFT JOIN
                `domains` ON `links`.`domain_id` = `domains`.`domain_id`
            WHERE
                1 = 1
                {$filters->get_sql_where('links')}
                {$filters->get_sql_order_by('links')}

            {$paginator->get_sql_limit()}
        ");
        while($row = $links_result->fetch_object()) {
            $links[] = $row;
        }

        /* Export handler */
        process_export_csv($links, 'include', ['link_id', 'user_id', 'domain_id', 'project_id', 'pixels_ids', 'url', 'location_url', 'password', 'pageviews', 'is_enabled', 'datetime'], sprintf(l('links.title')));
        process_export_json($links, 'include', ['link_id', 'user_id', 'domain_id', 'project_id', 'pixels_ids', 'url', 'location_url', 'settings', 'password', 'pageviews', 'is_enabled', 'datetime'], sprintf(l('links.title')));

        /* Prepare the pagination view */
        $pagination = (new \Altum\View('partials/admin_pagination', (array) $this))->run(['paginator' => $paginator]);

        /* Main View */
        $data = [
            'links' => $links,
            'filters' => $filters,
            'pagination' => $pagination
        ];

        $view = new \Altum\View('admin/links/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

    public function bulk() {

        /* Check for any errors */
        if(empty($_POST)) {
            redirect('admin/links');
        }

        if(empty($_POST['selected'])) {
            redirect('admin/links');
        }

        if(!isset($_POST['type'])) {
            redirect('admin/links');
        }

        //ALTUMCODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            set_time_limit(0);
            
            switch($_POST['type']) {
                case 'delete':

                    foreach($_POST['selected'] as $link_id) {

                        (new \Altum\Models\Link())->delete($link_id);

                    }

                    break;
            }

            /* Set a nice success message */
            Alerts::add_success(l('bulk_delete_modal.success_message'));

        }

        redirect('admin/links');
    }

    public function delete() {

        $link_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        //ALTUMCODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check('global_token')) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!$link = db()->where('link_id', $link_id)->getOne('links', ['link_id', 'url'])) {
            redirect('admin/links');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            (new \Altum\Models\Link())->delete($link->link_id);

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.delete1'), '<strong>' . $link->url . '</strong>'));

        }

        redirect('admin/links');
    }

    public function transfer() {

        if(empty($_POST)) {
            redirect('admin/links');
        }

        $link_id = (int) $_POST['link_id'];
        $_POST['email'] = mb_substr(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), 0, 320);

        //ALTUMCODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!$link = db()->where('link_id', $link_id)->getOne('links', ['link_id', 'user_id', 'url'])) {
            redirect('admin/links');
        }

        if(!$current_user = db()->where('user_id', $link->user_id)->getOne('users', ['user_id', 'email'])) {
            redirect('admin/links');
        }

        if(!$new_user = db()->where('email', $_POST['email'])->getOne('users', ['user_id', 'email'])) {
            redirect('admin/links');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Update the database */
            db()->where('link_id', $link->link_id)->update('links', [
                'user_id' => $new_user->user_id,
            ]);

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('transfer_modal.success_message'), '<strong>' . input_clean($link->url) . '</strong>', '<strong>' . input_clean($current_user->email) . '</strong>', '<strong>' . input_clean($new_user->email) . '</strong>'));

            /* Clear the cache */
            cache()->deleteItemsByTag('user_id=' . $current_user->user_id);
            cache()->deleteItemsByTag('user_id=' . $new_user->user_id);

            /* Redirect */
            redirect('admin/links');

        }

        redirect('admin/links');
    }

}
