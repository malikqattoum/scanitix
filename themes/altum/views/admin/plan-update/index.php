<?php defined('ALTUMCODE') || die() ?>

<?php if(settings()->main->breadcrumbs_is_enabled): ?>
    <nav aria-label="breadcrumb">
        <ol class="custom-breadcrumbs small">
            <li>
                <a href="<?= url('admin/plans') ?>"><?= l('admin_plans.breadcrumb') ?></a><i class="fas fa-fw fa-angle-right"></i>
            </li>
            <li class="active" aria-current="page"><?= l('admin_plan_update.breadcrumb') ?></li>
        </ol>
    </nav>
<?php endif ?>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0 text-truncate"><i class="fas fa-fw fa-xs fa-box-open text-primary-900 mr-2"></i> <?= l('admin_plan_update.header') ?></h1>

    <?= include_view(THEME_PATH . 'views/admin/plans/admin_plan_dropdown_button.php', ['id' => $data->plan->plan_id]) ?>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<div class="card">
    <div class="card-body">

        <form action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />
            <input type="hidden" name="type" value="update" />

            <?php if(is_numeric($data->plan_id)): ?>
                <div class="form-group">
                    <label for="plan_id"><?= l('admin_plans.main.plan_id') ?></label>
                    <input type="text" id="plan_id" name="plan_id" class="form-control <?= \Altum\Alerts::has_field_errors('plan_id') ? 'is-invalid' : null ?>" value="<?= $data->plan->plan_id ?>" disabled="disabled" />
                    <?= \Altum\Alerts::output_field_error('name') ?>
                </div>
            <?php endif ?>

            <div class="form-group">
                <label for="name"><i class="fas fa-fw fa-sm fa-signature text-muted mr-1"></i> <?= l('global.name') ?></label>
                <div class="input-group">
                    <input type="text" id="name" name="name" class="form-control <?= \Altum\Alerts::has_field_errors('name') ? 'is-invalid' : null ?>" value="<?= $data->plan->name ?>" maxlength="64" required="required" />
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#name_translate_container" aria-expanded="false" aria-controls="name_translate_container" data-tooltip title="<?= l('global.translate') ?>" data-tooltip-hide-on-click><i class="fas fa-fw fa-sm fa-language"></i></button>
                    </div>
                </div>
                <?= \Altum\Alerts::output_field_error('name') ?>
            </div>

            <div class="collapse" id="name_translate_container">
                <div class="p-3 bg-gray-50 rounded mb-4">
                    <?php foreach(\Altum\Language::$active_languages as $language_name => $language_code): ?>
                        <div class="form-group">
                            <label for="<?= 'translation_' . $language_name . '_name' ?>"><i class="fas fa-fw fa-sm fa-signature text-muted mr-1"></i> <?= l('global.name') ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><?= $language_name ?></span>
                                </div>
                                <input type="text" id="<?= 'translation_' . $language_name . '_name' ?>" name="<?= 'translations[' . $language_name . '][name]' ?>" value="<?= $data->plan->translations->{$language_name}->name ?? null ?>" class="form-control" maxlength="64" />
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="form-group">
                <label for="description"><i class="fas fa-fw fa-sm fa-pen text-muted mr-1"></i> <?= l('global.description') ?></label>
                <div class="input-group">
                    <input type="text" id="description" name="description" class="form-control <?= \Altum\Alerts::has_field_errors('description') ? 'is-invalid' : null ?>" value="<?= $data->plan->description ?>" maxlength="256" />
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#description_translate_container" aria-expanded="false" aria-controls="description_translate_container" data-tooltip title="<?= l('global.translate') ?>" data-tooltip-hide-on-click><i class="fas fa-fw fa-sm fa-language"></i></button>
                    </div>
                </div>
                <?= \Altum\Alerts::output_field_error('description') ?>
            </div>

            <div class="collapse" id="description_translate_container">
                <div class="p-3 bg-gray-50 rounded mb-4">
                    <?php foreach(\Altum\Language::$active_languages as $language_name => $language_code): ?>
                        <div class="form-group">
                            <label for="<?= 'translation_' . $language_name . '_description' ?>"><i class="fas fa-fw fa-sm fa-pen text-muted mr-1"></i> <?= l('global.description') ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><?= $language_name ?></span>
                                </div>
                                <input type="text" id="<?= 'translation_' . $language_name . '_description' ?>" name="<?= 'translations[' . $language_name . '][description]' ?>" value="<?= $data->plan->translations->{$language_name}->description ?? null ?>" class="form-control" maxlength="256" />
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <?php if(in_array($data->plan_id, ['guest', 'free', 'custom'])): ?>
                <div class="form-group">
                    <label for="price"><i class="fas fa-fw fa-sm fa-tag text-muted mr-1"></i> <?= l('admin_plans.main.price') ?></label>
                    <div class="input-group">
                        <input type="text" id="price" name="price" class="form-control <?= \Altum\Alerts::has_field_errors('price') ? 'is-invalid' : null ?>" value="<?= $data->plan->price ?>" required="required" />
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#price_translate_container" aria-expanded="false" aria-controls="price_translate_container" data-tooltip title="<?= l('global.translate') ?>" data-tooltip-hide-on-click><i class="fas fa-fw fa-sm fa-language"></i></button>
                        </div>
                    </div>
                    <?= \Altum\Alerts::output_field_error('price') ?>
                </div>

                <div class="collapse" id="price_translate_container">
                    <div class="p-3 bg-gray-50 rounded mb-4">
                        <?php foreach(\Altum\Language::$active_languages as $language_name => $language_code): ?>
                            <div class="form-group">
                                <label for="<?= 'translation_' . $language_name . '_price' ?>"><i class="fas fa-fw fa-sm fa-tag text-muted mr-1"></i> <?= l('admin_plans.main.price') ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><?= $language_name ?></span>
                                    </div>
                                    <input type="text" id="<?= 'translation_' . $language_name . '_price' ?>" name="<?= 'translations[' . $language_name . '][price]' ?>" value="<?= $data->plan->translations->{$language_name}->price ?? null ?>" class="form-control" maxlength="256" />
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>

            <?php if($data->plan_id == 'custom'): ?>
                <div class="form-group">
                    <label for="custom_button_url"><i class="fas fa-fw fa-sm fa-link text-muted mr-1"></i> <?= l('admin_plans.main.custom_button_url') ?></label>
                    <input type="text" id="custom_button_url" name="custom_button_url" class="form-control <?= \Altum\Alerts::has_field_errors('custom_button_url') ? 'is-invalid' : null ?>" value="<?= $data->plan->custom_button_url ?>" required="required" />
                    <?= \Altum\Alerts::output_field_error('custom_button_url') ?>
                </div>
            <?php endif ?>

            <?php if(is_numeric($data->plan_id)): ?>
                <div class="form-group">
                    <label for="order"><i class="fas fa-fw fa-sm fa-sort text-muted mr-1"></i> <?= l('global.order') ?></label>
                    <input id="order" type="number" min="0"  name="order" class="form-control" value="<?= $data->plan->order ?>" />
                </div>

                <div class="form-group">
                    <label for="trial_days"><i class="fas fa-fw fa-sm fa-calendar-check text-muted mr-1"></i> <?= l('admin_plans.main.trial_days') ?></label>
                    <input id="trial_days" type="number" min="0" name="trial_days" class="form-control" value="<?= $data->plan->trial_days ?>" />
                    <div><small class="form-text text-muted"><?= l('admin_plans.main.trial_days_help') ?></small></div>
                </div>

                <?php foreach((array) settings()->payment->currencies as $currency => $currency_data): ?>
                    <div class="row">
                        <div class="col-sm-12 col-xl-4">
                            <div class="form-group">
                                <label for="monthly_price[<?= $currency ?>]"><i class="fas fa-fw fa-sm fa-calendar-alt text-muted mr-1"></i> <?= l('admin_plans.main.monthly_price') ?></label>
                                <div class="input-group">
                                    <input type="text" id="monthly_price[<?= $currency ?>]" name="monthly_price[<?= $currency ?>]" class="form-control <?= \Altum\Alerts::has_field_errors('monthly_price[' . $currency . ']') ? 'is-invalid' : null ?>" value="<?= $data->plan->prices->monthly->{$currency} ?? 0 ?>" required="required" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><?= $currency ?></span>
                                    </div>
                                </div>
                                <?= \Altum\Alerts::output_field_error('monthly_price[' . $currency . ']') ?>
                                <small class="form-text text-muted"><?= sprintf(l('admin_plans.main.price_help'), l('admin_plans.main.monthly_price')) ?></small>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xl-4">
                            <div class="form-group">
                                <label for="annual_price[<?= $currency ?>]"><i class="fas fa-fw fa-sm fa-calendar text-muted mr-1"></i> <?= l('admin_plans.main.annual_price') ?></label>
                                <div class="input-group">
                                    <input type="text" id="annual_price[<?= $currency ?>]" name="annual_price[<?= $currency ?>]" class="form-control <?= \Altum\Alerts::has_field_errors('annual_price[' . $currency . ']') ? 'is-invalid' : null ?>" value="<?= $data->plan->prices->annual->{$currency} ?? 0 ?>" required="required" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><?= $currency ?></span>
                                    </div>
                                </div>
                                <?= \Altum\Alerts::output_field_error('annual_price[' . $currency . ']') ?>
                                <small class="form-text text-muted"><?= sprintf(l('admin_plans.main.price_help'), l('admin_plans.main.annual_price')) ?></small>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xl-4">
                            <div class="form-group">
                                <label for="lifetime_price[<?= $currency ?>]"><i class="fas fa-fw fa-sm fa-infinity text-muted mr-1"></i> <?= l('admin_plans.main.lifetime_price') ?></label>
                                <div class="input-group">
                                    <input type="text" id="lifetime_price[<?= $currency ?>]" name="lifetime_price[<?= $currency ?>]" class="form-control <?= \Altum\Alerts::has_field_errors('lifetime_price[' . $currency . ']') ? 'is-invalid' : null ?>" value="<?= $data->plan->prices->lifetime->{$currency} ?? 0 ?>" required="required" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><?= $currency ?></span>
                                    </div>
                                </div>
                                <?= \Altum\Alerts::output_field_error('lifetime_price[' . $currency . ']') ?>
                                <small class="form-text text-muted"><?= sprintf(l('admin_plans.main.price_help'), l('admin_plans.main.lifetime_price')) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

                <div class="form-group">
                    <label for="taxes_ids"><i class="fas fa-fw fa-sm fa-paperclip text-muted mr-1"></i> <?= l('admin_plans.main.taxes_ids') ?></label>
                    <select id="taxes_ids" name="taxes_ids[]" class="custom-select" multiple="multiple">
                        <?php if($data->taxes): ?>
                            <?php foreach($data->taxes as $tax): ?>
                                <option value="<?= $tax->tax_id ?>" <?= in_array($tax->tax_id, $data->plan->taxes_ids)  ? 'selected="selected"' : null ?>>
                                    <?= $tax->name . ' - ' . $tax->description ?>
                                </option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                    <small class="form-text text-muted"><?= sprintf(l('admin_plans.main.taxes_ids_help'), '<a href="' . url('admin/taxes') .'">', '</a>') ?></small>
                </div>

            <?php endif ?>

            <div class="form-group">
                <label for="color"><i class="fas fa-fw fa-sm fa-palette text-muted mr-1"></i> <?= l('admin_plans.main.color') ?></label>
                <input type="text" id="color" name="color" class="form-control <?= \Altum\Alerts::has_field_errors('color') ? 'is-invalid' : null ?>" value="<?= $data->plan->color ?>" />
                <?= \Altum\Alerts::output_field_error('color') ?>
                <small class="form-text text-muted"><?= l('admin_plans.main.color_help') ?></small>
            </div>

            <div class="form-group">
                <label for="status"><i class="fas fa-fw fa-sm fa-circle-dot text-muted mr-1"></i> <?= l('global.status') ?></label>
                <select id="status" name="status" class="custom-select">
                    <option value="1" <?= $data->plan->status == 1 ? 'selected="selected"' : null ?>><?= l('global.active') ?></option>
                    <option value="0" <?= $data->plan->status == 0 ? 'selected="selected"' : null ?> <?= $data->plan->plan_id == 'custom' ? 'disabled="disabled"' : null ?>><?= l('global.disabled') ?></option>
                    <option value="2" <?= $data->plan->status == 2 ? 'selected="selected"' : null ?>><?= l('global.hidden') ?></option>
                </select>
            </div>

            <h2 class="h4 mt-5 mb-4"><?= l('admin_plans.plan.header') ?></h2>

            <div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="url_minimum_characters"><?= l('admin_plans.plan.url_minimum_characters') ?></label>
                            <input type="number" id="url_minimum_characters" name="url_minimum_characters" min="1" class="form-control" value="<?= $data->plan->settings->url_minimum_characters ?? 1 ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="url_maximum_characters"><?= l('admin_plans.plan.url_maximum_characters') ?></label>
                            <input type="number" id="url_maximum_characters" name="url_maximum_characters" min="1" max="256" class="form-control" value="<?= $data->plan->settings->url_maximum_characters ?? 64 ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="qr_codes_limit"><?= l('admin_plans.plan.qr_codes_limit') ?></label>
                    <input type="number" id="qr_codes_limit" name="qr_codes_limit" min="-1" class="form-control" value="<?= $data->plan->settings->qr_codes_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                    <small class="form-text text-muted"><?= l('admin_plans.plan.unlimited') ?></small>
                </div>

                <div class="form-group">
                    <label for="qr_codes_bulk_limit"><?= l('admin_plans.plan.qr_codes_bulk_limit') ?></label>
                    <input type="number" id="qr_codes_bulk_limit" name="qr_codes_bulk_limit" min="-1" class="form-control" value="<?= $data->plan->settings->qr_codes_bulk_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                </div>

                <div class="form-group">
                    <label for="barcodes_limit"><?= l('admin_plans.plan.barcodes_limit') ?></label>
                    <input type="number" id="barcodes_limit" name="barcodes_limit" min="-1" class="form-control" value="<?= $data->plan->settings->barcodes_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                    <small class="form-text text-muted"><?= l('admin_plans.plan.unlimited') ?></small>
                </div>

                <div class="form-group">
                    <label for="barcodes_bulk_limit"><?= l('admin_plans.plan.barcodes_bulk_limit') ?></label>
                    <input type="number" id="barcodes_bulk_limit" name="barcodes_bulk_limit" min="-1" class="form-control" value="<?= $data->plan->settings->barcodes_bulk_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                </div>

                <div class="form-group">
                    <label for="links_limit"><?= l('admin_plans.plan.links_limit') ?></label>
                    <input type="number" id="links_limit" name="links_limit" min="-1" class="form-control" value="<?= $data->plan->settings->links_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                    <small class="form-text text-muted"><?= l('admin_plans.plan.unlimited') ?></small>
                </div>

                <div class="form-group">
                    <label for="projects_limit"><?= l('admin_plans.plan.projects_limit') ?></label>
                    <input type="number" id="projects_limit" name="projects_limit" min="-1" class="form-control" value="<?= $data->plan->settings->projects_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                    <small class="form-text text-muted"><?= l('admin_plans.plan.unlimited') ?></small>
                </div>

                <div class="form-group">
                    <label for="pixels_limit"><?= l('admin_plans.plan.pixels_limit') ?></label>
                    <input type="number" id="pixels_limit" name="pixels_limit" min="-1" class="form-control" value="<?= $data->plan->settings->pixels_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                    <small class="form-text text-muted"><?= l('admin_plans.plan.unlimited') ?></small>
                </div>

                <div class="form-group">
                    <label for="domains_limit"><?= l('admin_plans.plan.domains_limit') ?></label>
                    <input type="number" id="domains_limit" name="domains_limit" min="-1" class="form-control" value="<?= $data->plan->settings->domains_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                    <small class="form-text text-muted"><?= l('admin_plans.plan.unlimited') ?></small>
                </div>

                <?php if(\Altum\Plugin::is_active('teams')): ?>
                    <div class="form-group">
                        <label for="teams_limit"><?= l('admin_plans.plan.teams_limit') ?></label>
                        <input type="number" id="teams_limit" name="teams_limit" min="-1" class="form-control" value="<?= $data->plan->settings->teams_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                        <small class="form-text text-muted"><?= l('admin_plans.plan.unlimited') ?></small>
                    </div>

                    <div class="form-group">
                        <label for="team_members_limit"><?= l('admin_plans.plan.team_members_limit') ?></label>
                        <input type="number" id="team_members_limit" name="team_members_limit" min="-1" class="form-control" value="<?= $data->plan->settings->team_members_limit ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                        <small class="form-text text-muted"><?= l('admin_plans.plan.unlimited') ?></small>
                    </div>
                <?php endif ?>

                <?php if(\Altum\Plugin::is_active('affiliate')): ?>
                    <div class="form-group">
                        <label for="affiliate_commission_percentage"><?= l('admin_plans.plan.affiliate_commission_percentage') ?></label>
                        <input type="number" id="affiliate_commission_percentage" name="affiliate_commission_percentage" min="0" max="100" class="form-control" value="<?= $data->plan->settings->affiliate_commission_percentage ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                        <small class="form-text text-muted"><?= l('admin_plans.plan.affiliate_commission_percentage_help') ?></small>
                    </div>
                <?php endif ?>

                <div class="form-group">
                    <label for="statistics_retention"><?= l('admin_plans.plan.statistics_retention') ?></label>
                    <div class="input-group">
                        <input type="number" id="statistics_retention" name="statistics_retention" min="-1" class="form-control" value="<?= $data->plan->settings->statistics_retention ?>" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?> />
                        <div class="input-group-append">
                            <span class="input-group-text"><?= l('global.date.days') ?></span>
                        </div>
                    </div>
                    <small class="form-text text-muted"><?= l('admin_plans.plan.statistics_retention_help') ?></small>
                </div>

                <div class="form-group">
                    <label for="additional_domains"><?= l('admin_plans.plan.additional_domains') ?></label>
                    <select id="additional_domains" name="additional_domains[]" class="custom-select" multiple="multiple" <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                        <?php foreach($data->additional_domains as $domain): ?>
                            <option value="<?= $domain->domain_id ?>" <?= in_array($domain->domain_id, $data->plan->settings->additional_domains ?? [])  ? 'selected="selected"' : null ?>>
                                <?= $domain->host ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="no_ads" name="no_ads" type="checkbox" class="custom-control-input" <?= $data->plan->settings->no_ads ? 'checked="checked"' : null ?>>
                    <label class="custom-control-label" for="no_ads"><?= l('admin_plans.plan.no_ads') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.no_ads_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="removable_branding" name="removable_branding" type="checkbox" class="custom-control-input" <?= $data->plan->settings->removable_branding ? 'checked="checked"' : null ?>>
                    <label class="custom-control-label" for="removable_branding"><?= l('admin_plans.plan.removable_branding') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.removable_branding_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="analytics_is_enabled" name="analytics_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->analytics_is_enabled ? 'checked="checked"' : null ?> <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                    <label class="custom-control-label" for="analytics_is_enabled"><?= l('admin_plans.plan.analytics_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.analytics_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="custom_url_is_enabled" name="custom_url_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->custom_url_is_enabled ? 'checked="checked"' : null ?> <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                    <label class="custom-control-label" for="custom_url_is_enabled"><?= l('admin_plans.plan.custom_url_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.custom_url_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="utm_parameters_is_enabled" name="utm_parameters_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->utm_parameters_is_enabled ? 'checked="checked"' : null ?> <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                    <label class="custom-control-label" for="utm_parameters_is_enabled"><?= l('admin_plans.plan.utm_parameters_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.utm_parameters_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="password_protection_is_enabled" name="password_protection_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->password_protection_is_enabled ? 'checked="checked"' : null ?> <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                    <label class="custom-control-label" for="password_protection_is_enabled"><?= l('admin_plans.plan.password_protection_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.password_protection_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="sensitive_content_is_enabled" name="sensitive_content_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->sensitive_content_is_enabled ? 'checked="checked"' : null ?> <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                    <label class="custom-control-label" for="sensitive_content_is_enabled"><?= l('admin_plans.plan.sensitive_content_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.sensitive_content_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="cloaking_is_enabled" name="cloaking_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->cloaking_is_enabled ? 'checked="checked"' : null ?> <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                    <label class="custom-control-label" for="cloaking_is_enabled"><?= l('admin_plans.plan.cloaking_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.cloaking_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="app_linking_is_enabled" name="app_linking_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->app_linking_is_enabled ? 'checked="checked"' : null ?> <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                    <label class="custom-control-label" for="app_linking_is_enabled"><?= l('admin_plans.plan.app_linking_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.app_linking_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="api_is_enabled" name="api_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->api_is_enabled ? 'checked="checked"' : null ?> <?= $data->plan_id == 'guest' ? 'disabled="disabled"' : null ?>>
                    <label class="custom-control-label" for="api_is_enabled"><?= l('admin_plans.plan.api_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.api_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="qr_reader_is_enabled" name="qr_reader_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->qr_reader_is_enabled ? 'checked="checked"' : null ?>>
                    <label class="custom-control-label" for="qr_reader_is_enabled"><?= l('admin_plans.plan.qr_reader_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.qr_reader_is_enabled_help') ?></small></div>
                </div>

                <div class="form-group custom-control custom-switch">
                    <input id="barcode_reader_is_enabled" name="barcode_reader_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->barcode_reader_is_enabled ? 'checked="checked"' : null ?>>
                    <label class="custom-control-label" for="barcode_reader_is_enabled"><?= l('admin_plans.plan.barcode_reader_is_enabled') ?></label>
                    <div><small class="form-text text-muted"><?= l('admin_plans.plan.barcode_reader_is_enabled_help') ?></small></div>
                </div>

                <h3 class="h5 mt-4"><?= l('admin_plans.plan.enabled_qr_codes') ?></h3>
                <p class="text-muted"><?= l('admin_plans.plan.enabled_qr_codes_help') ?></p>

                <div class="row">
                    <?php foreach(array_keys((require APP_PATH . 'includes/qr_codes.php')) as $key): ?>
                        <div class="col-6 mb-3">
                            <div class="custom-control custom-switch">
                                <input id="enabled_qr_codes_<?= $key ?>" name="enabled_qr_codes[]" value="<?= $key ?>" type="checkbox" class="custom-control-input" <?= $data->plan->settings->enabled_qr_codes->{$key} ? 'checked="checked"' : null ?>>
                                <label class="custom-control-label" for="enabled_qr_codes_<?= $key ?>"><?= l('qr_codes.type.' . mb_strtolower($key)) ?></label>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

                <h3 class="h5 mt-4"><?= l('admin_plans.plan.enabled_barcodes') ?></h3>
                <p class="text-muted"><?= l('admin_plans.plan.enabled_barcodes_help') ?></p>

                <div class="row">
                    <?php foreach(array_keys((require APP_PATH . 'includes/barcodes.php')) as $key): ?>
                        <div class="col-6 mb-3">
                            <div class="custom-control custom-switch">
                                <input id="enabled_barcodes_<?= $key ?>" name="enabled_barcodes[]" value="<?= $key ?>" type="checkbox" class="custom-control-input" <?= $data->plan->settings->enabled_barcodes->{$key} ? 'checked="checked"' : null ?>>
                                <label class="custom-control-label" for="enabled_barcodes_<?= $key ?>"><?= $key ?></label>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <?php if($data->plan_id == 'custom'): ?>
                <div class="alert alert-warning" role="alert"><?= l('admin_plans.main.custom_help') ?></div>
                <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
            <?php elseif($data->plan_id == 'guest'): ?>
                <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
            <?php else: ?>
                <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
                <button type="submit" name="submit_update_users_plan_settings" class="btn btn-lg btn-block btn-outline-primary mt-2"><?= l('admin_plan_update.update_users_plan_settings.button') ?></button>
            <?php endif ?>
        </form>

    </div>
</div>
