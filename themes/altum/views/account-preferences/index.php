<?php defined('ALTUMCODE') || die() ?>

<div class="container">
    <?= \Altum\Alerts::output_alerts() ?>

    <?= $this->views['account_header_menu'] ?>

    <div class="d-flex align-items-center mb-3">
        <h1 class="h4 m-0"><?= l('account_preferences.header') ?></h1>

        <div class="ml-2">
            <span data-toggle="tooltip" title="<?= l('account_preferences.subheader') ?>">
                <i class="fas fa-fw fa-info-circle text-muted"></i>
            </span>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="" method="post" role="form">
                <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />


                <div class="form-group">
                    <label for="default_results_per_page"><i class="fas fa-fw fa-sm fa-list-ol text-muted mr-1"></i> <?= l('account_preferences.input.default_results_per_page') ?></label>
                    <select id="default_results_per_page" name="default_results_per_page" class="custom-select <?= \Altum\Alerts::has_field_errors('default_results_per_page') ? 'is-invalid' : null ?>">
                        <?php foreach([10, 25, 50, 100, 250, 500, 1000] as $key): ?>
                            <option value="<?= $key ?>" <?= ($this->user->preferences->default_results_per_page ?? settings()->main->default_results_per_page) == $key ? 'selected="selected"' : null ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= \Altum\Alerts::output_field_error('default_results_per_page') ?>
                </div>

                <div class="form-group">
                    <label for="default_order_type"><i class="fas fa-fw fa-sm fa-sort text-muted mr-1"></i> <?= l('account_preferences.input.default_order_type') ?></label>
                    <select id="default_order_type" name="default_order_type" class="custom-select <?= \Altum\Alerts::has_field_errors('default_order_type') ? 'is-invalid' : null ?>">
                        <option value="ASC" <?= ($this->user->preferences->default_order_type ?? settings()->main->default_order_type) == 'ASC' ? 'selected="selected"' : null ?>><?= l('global.filters.order_type_asc') ?></option>
                        <option value="DESC" <?= ($this->user->preferences->default_order_type ?? settings()->main->default_order_type) == 'DESC' ? 'selected="selected"' : null ?>><?= l('global.filters.order_type_desc') ?></option>
                    </select>
                    <?= \Altum\Alerts::output_field_error('default_order_type') ?>
                </div>

                <div class="form-group">
                    <label for="links_default_order_by"><i class="fas fa-fw fa-sm fa-link text-muted mr-1"></i> <?= sprintf(l('account_preferences.input.default_order_by_x'), l('links.title')) ?></label>
                    <select id="links_default_order_by" name="links_default_order_by" class="custom-select <?= \Altum\Alerts::has_field_errors('links_default_order_by') ? 'is-invalid' : null ?>">
                        <option value="link_id" <?= $this->user->preferences->links_default_order_by == 'link_id' ? 'selected="selected"' : null ?>><?= l('global.id') ?></option>
                        <option value="datetime" <?= $this->user->preferences->links_default_order_by == 'datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_datetime') ?></option>
                        <option value="last_datetime" <?= $this->user->preferences->links_default_order_by == 'last_datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_last_datetime') ?></option>
                        <option value="url" <?= $this->user->preferences->links_default_order_by == 'url' ? 'selected="selected"' : null ?>><?= l('links.filters.order_by_url') ?></option>
                        <option value="location_url" <?= $this->user->preferences->links_default_order_by == 'location_url' ? 'selected="selected"' : null ?>><?= l('links.filters.order_by_location_url') ?></option>
                        <option value="pageviews" <?= $this->user->preferences->links_default_order_by == 'pageviews' ? 'selected="selected"' : null ?>><?= l('links.filters.order_by_pageviews') ?></option>
                    </select>
                    <?= \Altum\Alerts::output_field_error('links_default_order_by') ?>
                </div>

                <?php if(settings()->codes->qr_codes_is_enabled): ?>
                <div class="form-group">
                    <label for="qr_codes_default_order_by"><i class="fas fa-fw fa-sm fa-qrcode text-muted mr-1"></i> <?= sprintf(l('account_preferences.input.default_order_by_x'), l('qr_codes.title')) ?></label>
                    <select id="qr_codes_default_order_by" name="qr_codes_default_order_by" class="custom-select <?= \Altum\Alerts::has_field_errors('qr_codes_default_order_by') ? 'is-invalid' : null ?>">
                        <option value="qr_code_id" <?= $this->user->preferences->qr_codes_default_order_by == 'qr_code_id' ? 'selected="selected"' : null ?>><?= l('global.id') ?></option>
                        <option value="datetime" <?= $this->user->preferences->qr_codes_default_order_by == 'datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_datetime') ?></option>
                        <option value="last_datetime" <?= $this->user->preferences->qr_codes_default_order_by == 'last_datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_last_datetime') ?></option>
                        <option value="name" <?= $this->user->preferences->qr_codes_default_order_by == 'name' ? 'selected="selected"' : null ?>><?= l('global.name') ?></option>
                        <option value="type" <?= $this->user->preferences->qr_codes_default_order_by == 'type' ? 'selected="selected"' : null ?>><?= l('global.type') ?></option>
                    </select>
                    <?= \Altum\Alerts::output_field_error('qr_codes_default_order_by') ?>
                </div>
                <?php endif ?>

                <?php if(settings()->codes->barcodes_is_enabled): ?>
                <div class="form-group">
                    <label for="barcodes_default_order_by"><i class="fas fa-fw fa-sm fa-barcode text-muted mr-1"></i> <?= sprintf(l('account_preferences.input.default_order_by_x'), l('barcodes.title')) ?></label>
                    <select id="barcodes_default_order_by" name="barcodes_default_order_by" class="custom-select <?= \Altum\Alerts::has_field_errors('barcodes_default_order_by') ? 'is-invalid' : null ?>">
                        <option value="barcode_id" <?= $this->user->preferences->barcodes_default_order_by == 'barcode_id' ? 'selected="selected"' : null ?>><?= l('global.id') ?></option>
                        <option value="datetime" <?= $this->user->preferences->barcodes_default_order_by == 'datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_datetime') ?></option>
                        <option value="last_datetime" <?= $this->user->preferences->barcodes_default_order_by == 'last_datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_last_datetime') ?></option>
                        <option value="name" <?= $this->user->preferences->barcodes_default_order_by == 'name' ? 'selected="selected"' : null ?>><?= l('global.name') ?></option>
                        <option value="type" <?= $this->user->preferences->barcodes_default_order_by == 'type' ? 'selected="selected"' : null ?>><?= l('global.type') ?></option>
                    </select>
                    <?= \Altum\Alerts::output_field_error('barcodes_default_order_by') ?>
                </div>
                <?php endif ?>

                <button type="submit" name="submit" class="btn btn-block btn-primary"><?= l('global.update') ?></button>
            </form>
        </div>
    </div>
</div>
