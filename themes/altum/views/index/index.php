<?php defined('ALTUMCODE') || die() ?>

<div class="index-background py-9" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <?= \Altum\Alerts::output_alerts() ?>

        <div class="row justify-content-center">
            <div class="col-11 col-md-10 col-lg-7">
                <h1 class="index-header text-center mb-4 text-white" style="font-weight: 700; letter-spacing: -0.5px; font-size: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">Scanitix <?= l('index.header') ?></h1>
            </div>

            <div class="col-10 col-sm-8 col-lg-6">
                <p class="index-subheader text-center mb-5 text-white" style="font-size: 1.25rem; font-weight: 300;"><?= l('index.subheader') ?></p>
            </div>
        </div>

        <div class="d-flex flex-column flex-lg-row justify-content-center gap-3">
            <?php if(settings()->codes->qr_codes_is_enabled): ?>
                <a href="<?= \Altum\Authentication::check() ? url('qr-code-create') : url('qr/text') ?>" class="btn btn-gradient-primary text-white shadow-lg index-button mb-3 mb-lg-0" style="border-radius: 50px; padding: 12px 30px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; transform: translateY(0); box-shadow: 0 10px 20px rgba(0,0,0,0.1); background: linear-gradient(45deg, #667eea, #764ba2);">
                    <i class="fas fa-fw fa-sm fa-qrcode mr-2"></i> <?= l('index.qr') ?>
                </a>
            <?php endif ?>

            <?php if(settings()->codes->barcodes_is_enabled): ?>
                <a href="<?= \Altum\Authentication::check() ? url('barcode-create') : url('barcode') ?>" class="btn btn-gradient-primary text-white shadow-lg index-button mb-3 mb-lg-0" style="border-radius: 50px; padding: 12px 30px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; transform: translateY(0); box-shadow: 0 10px 20px rgba(0,0,0,0.1); background: linear-gradient(45deg, #667eea, #764ba2);">
                    <i class="fas fa-fw fa-sm fa-barcode mr-2"></i> <?= l('index.barcode') ?>
                </a>
            <?php endif ?>
        </div>

        <?php if(settings()->codes->qr_reader_is_enabled || settings()->codes->barcode_reader_is_enabled): ?>
            <div class="d-flex flex-row justify-content-center mt-4 gap-2">
                <?php if(settings()->codes->qr_reader_is_enabled): ?>
                    <a href="<?= url('qr-reader') ?>" class="btn btn-white-20 text-white index-button-secondary p-3" data-toggle="tooltip" title="<?= l('qr_reader.menu') ?>" style="border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                        <i class="fas fa-fw fa-sm fa-glasses"></i>
                    </a>
                <?php endif ?>

                <?php if(settings()->codes->barcode_reader_is_enabled): ?>
                    <a href="<?= url('barcode-reader') ?>" class="btn btn-white-20 text-white index-button-secondary p-3" data-toggle="tooltip" title="<?= l('barcode_reader.menu') ?>" style="border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                        <i class="fas fa-fw fa-sm fa-print"></i>
                    </a>
                <?php endif ?>
            </div>
        <?php endif ?>

    </div>
</div>

<div class="container">
    <div class="row justify-content-center mt-8" data-aos="fade-up">
        <div class="col-12">
            <img src="<?= ASSETS_FULL_URL . 'images/index/hero.png' ?>" class="img-fluid shadow-lg rounded-3xl" loading="lazy" style="border-radius: 24px; max-height: 500px; object-fit: cover;" />
        </div>
    </div>
</div>
<div class="my-5">&nbsp;</div>

<div class="container">
    <div class="row">
        <!-- QR Templates Widget -->
        <?php if(settings()->codes->qr_codes_is_enabled): ?>
            <div class="col-12 col-lg-4 p-3">
                <div class="card h-100 border-0 shadow-sm hover-lift" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body p-4 d-flex flex-column align-items-center text-center">
                        <div class="mt-3 mb-4 p-4 bg-gradient-success bg-opacity-10 rounded-full" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-fw fa-lg fa-qrcode" style="color: #10b981; font-size: 2rem;"></i>
                        </div>
                        <div class="mb-3">
                            <h3 class="h4 mb-1"><?= l('index.qr_templates.header') ?></h3>
                        </div>
                        <p class="text-muted mb-0"><?= sprintf(l('index.qr_templates.subheader'), count($data->available_qr_codes)) ?></p>
                    </div>
                </div>
            </div>

            <!-- Privacy Widget -->
            <div class="col-12 col-lg-4 p-3">
                <div class="card h-100 border-0 shadow-sm hover-lift" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body p-4 d-flex flex-column align-items-center text-center">
                        <div class="mt-3 mb-4 p-4 bg-gradient-info bg-opacity-10 rounded-full" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-fw fa-lg fa-user-secret" style="color: #06b6d4; font-size: 2rem;"></i>
                        </div>
                        <div class="mb-3">
                            <h3 class="h4 mb-1"><?= l('index.privacy.header') ?></h3>
                        </div>
                        <p class="text-muted mb-0"><?= l('index.privacy.subheader') ?></p>
                    </div>
                </div>
            </div>

            <!-- Customization Widget -->
            <div class="col-12 col-lg-4 p-3">
                <div class="card h-100 border-0 shadow-sm hover-lift" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body p-4 d-flex flex-column align-items-center text-center">
                        <div class="mt-3 mb-4 p-4 bg-gradient-primary bg-opacity-10 rounded-full" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-fw fa-lg fa-tools" style="color: #6366f1; font-size: 2rem;"></i>
                        </div>
                        <div class="mb-3">
                            <h3 class="h4 mb-1"><?= l('index.customization.header') ?></h3>
                        </div>
                        <p class="text-muted mb-0"><?= l('index.customization.subheader') ?></p>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <!-- Short URLs Widget -->
        <div class="col-12 col-lg-4 p-3">
            <div class="card h-100 border-0 shadow-sm hover-lift" data-aos="fade-up" data-aos-delay="400">
                <div class="card-body p-4 d-flex flex-column align-items-center text-center">
                    <div class="mt-3 mb-4 p-4 bg-gradient-info bg-opacity-10 rounded-full" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-fw fa-lg fa-link" style="color: #06b6d4; font-size: 2rem;"></i>
                    </div>
                    <div class="mb-3">
                        <h3 class="h4 mb-1"><?= l('index.short_urls.header') ?></h3>
                    </div>
                    <p class="text-muted mb-0"><?= l('index.short_urls.subheader') ?></p>
                </div>
            </div>
        </div>

        <!-- Projects Widget -->
        <div class="col-12 col-lg-4 p-3">
            <div class="card h-100 border-0 shadow-sm hover-lift" data-aos="fade-up" data-aos-delay="500">
                <div class="card-body p-4 d-flex flex-column align-items-center text-center">
                    <div class="mt-3 mb-4 p-4 bg-gradient-purple bg-opacity-10 rounded-full" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-fw fa-lg fa-tasks" style="color: #a855f7; font-size: 2rem;"></i>
                    </div>
                    <div class="mb-3">
                        <h3 class="h4 mb-1"><?= l('index.projects.header') ?></h3>
                    </div>
                    <p class="text-muted mb-0"><?= l('index.projects.subheader') ?></p>
                </div>
            </div>
        </div>

        <!-- Domains Widget -->
        <div class="col-12 col-lg-4 p-3">
            <div class="card h-100 border-0 shadow-sm hover-lift" data-aos="fade-up" data-aos-delay="600">
                <div class="card-body p-4 d-flex flex-column align-items-center text-center">
                    <div class="mt-3 mb-4 p-4 bg-gradient-pink bg-opacity-10 rounded-full" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-fw fa-lg fa-globe" style="color: #d946ef; font-size: 2rem;"></i>
                    </div>
                    <div class="mb-3">
                        <h3 class="h4 mb-1"><?= l('index.domains.header') ?></h3>
                    </div>
                    <p class="text-muted mb-0"><?= l('index.domains.subheader') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(settings()->codes->qr_codes_is_enabled): ?>
    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-lg-7 mb-5">
                <div class="position-relative overflow-hidden rounded-3xl shadow-lg" style="border-radius: 24px; overflow: hidden; max-height: 500px;">
                    <img src="<?= ASSETS_FULL_URL . 'images/index/static.png' ?>" class="img-fluid w-100 h-100 object-fit-cover" loading="lazy" style="border-radius: 24px;" />
                    <div class="position-absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-5">
                        <span class="badge bg-white text-primary px-3 py-1 rounded-full font-weight-bold">Static QR</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 mb-5 d-flex align-items-center">
                <div>
                <div class="bg-gradient-to-r from-primary to-primary-20 bg-opacity-10 p-4 rounded-2xl mb-4 d-inline-block">
                    <i class="fas fa-fw fa-lg fa-qrcode text-primary" style="font-size: 2.5rem;"></i>
                </div>

                    <h2 class="h3 mt-4 font-weight-bold"><?= l('index.static.header') ?></h2>
                    <p class="text-muted mt-3"><?= l('index.static.subheader') ?></p>

                    <div class="mt-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-opacity-10 p-2 rounded-full me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-0"><?= l('index.static.feature1') ?></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-opacity-10 p-2 rounded-full me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-0"><?= l('index.static.feature2') ?></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-opacity-10 p-2 rounded-full me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-0"><?= l('index.static.feature3') ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-lg-5 mb-5 d-flex align-items-center order-1 order-lg-0">
                <div>
                <div class="bg-gradient-to-r from-info to-info-20 bg-opacity-10 p-4 rounded-2xl mb-4 d-inline-block">
                    <i class="fas fa-fw fa-lg fa-link text-info" style="font-size: 2.5rem;"></i>
                </div>

                    <h2 class="h3 mt-4 font-weight-bold"><?= l('index.dynamic.header') ?></h2>
                    <p class="text-muted mt-3"><?= l('index.dynamic.subheader') ?></p>

                    <div class="mt-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-opacity-10 p-2 rounded-full me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-0"><?= l('index.dynamic.feature1') ?></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-opacity-10 p-2 rounded-full me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-0"><?= l('index.dynamic.feature2') ?></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-opacity-10 p-2 rounded-full me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-0"><?= l('index.dynamic.feature3') ?></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-opacity-10 p-2 rounded-full me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-0"><?= l('index.dynamic.feature4') ?></h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-opacity-10 p-2 rounded-full me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-0"><?= l('index.dynamic.feature5') ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 mb-5 order-0 order-lg-1">
                <div class="position-relative overflow-hidden rounded-3xl shadow-lg" style="border-radius: 24px; overflow: hidden; max-height: 500px;">
                    <img src="<?= ASSETS_FULL_URL . 'images/index/dynamic.png' ?>" class="img-fluid w-100 h-100 object-fit-cover" loading="lazy" style="border-radius: 24px;" />
                    <div class="position-absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-5">
                        <span class="badge bg-white text-info px-3 py-1 rounded-full font-weight-bold">Dynamic QR</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3"><?= l('index.qr_codes.header') ?></h2>
            <p class="text-muted lead"><?= l('index.qr_codes.subheader') ?></p>
        </div>

        <div class="row g-4">
            <?php foreach($data->available_qr_codes as $key => $value): ?>
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift transition-all" data-toggle="tooltip" title="<?= l('qr_codes.type.' . $key . '_description') ?>">
                        <div class="card-body p-4 d-flex flex-column align-items-center text-center">
                            <div class="p-4 bg-gradient-primary bg-opacity-10 rounded-3xl mb-4" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="<?= $value['icon'] ?> fa-fw fa-2x text-primary"></i>
                            </div>
                            <h3 class="h4 mb-3"><?= l('qr_codes.type.' . $key) ?></h3>
                            <p class="text-muted mb-4"><?= l('qr_codes.type.' . $key . '_description') ?></p>

                            <a href="<?= url('qr/' . $key) ?>" class="btn btn-gradient-purple mt-auto w-100 py-2 px-4 rounded-pill stretched-link" style="background: linear-gradient(45deg, #667eea, #764ba2); border: none; box-shadow: 0 4px 6px rgba(102, 126, 234, 0.1); color:white">
                                <i class="fas fa-arrow-right me-2"></i> <?= sprintf(l('index.qr_codes.choose'), l('qr_codes.type.' . $key)) ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?>


<?php if(settings()->codes->barcodes_is_enabled): ?>
    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3"><i class="fas fa-fw fa-xs fa-barcode text-primary mr-2"></i><?= l('index.barcodes.header') ?></h2>
            <p class="text-muted lead"><?= l('index.barcodes.subheader') ?></p>
        </div>

        <div class="row g-4">
            <?php foreach($data->available_barcodes as $key => $value): ?>
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift transition-all">
                        <div class="card-body p-4 d-flex flex-column align-items-center text-center">
                            <div class="p-4 bg-gradient-info bg-opacity-10 rounded-3xl mb-4" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-barcode fa-fw fa-2x text-info"></i>
                            </div>
                            <h3 class="h4 mb-3"><?= $key ?></h3>

                            <div class="d-flex justify-content-center my-3 bg-white p-4 rounded-2xl" style="max-width: 250px; border: 1px solid #e9ecef;">
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                echo $generator->getBarcode($value['example_value'], $key, 2, 100, 'black');
                                ?>
                            </div>

                            <a href="<?= url('barcode/' . str_replace('+', '-plus', $key)) ?>" class="btn btn-gradient-purple mt-auto w-100 py-2 px-4 rounded-pill stretched-link" style="background: linear-gradient(45deg, #667eea, #764ba2); border: none; box-shadow: 0 4px 6px rgba(102, 126, 234, 0.1); color: white;">
                                <i class="fas fa-arrow-right me-2"></i> <?= sprintf(l('index.barcodes.choose'), $key) ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?>

<div class="my-5">&nbsp;</div>

<div class="container">
    <div class="card py-4 bg-gray-900 border-0">
        <div class="card-body">
            <div class="text-center mb-4">
                <h2 class="text-white"><?= l('index.shortener_app_linking.header') ?></h2>
                <p class="text-muted"><?= l('index.shortener_app_linking.subheader') ?></p>
            </div>

            <div class="d-flex flex-wrap justify-content-center">
                <?php foreach(require APP_PATH . 'includes/app_linking.php' as $app_key => $app): ?>
                    <div class="bg-gray-800 rounded w-fit-content p-3 m-4 icon-zoom-animation" data-toggle="tooltip" title="<?= $app['name'] ?>">
                        <span title="<?= $app['name'] ?>"><i class="<?= $app['icon'] ?> fa-fw fa-xl mx-1" style="color: <?= $app['color'] ?>"></i></span>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<?php if(settings()->links->pixels_is_enabled): ?>
    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="card py-4 border-0">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h2><?= l('index.pixels.header') ?></h2>
                    <p class="text-muted"><?= l('index.pixels.subheader') ?></p>
                </div>

                <div class="row no-gutters">
                    <?php $i = 0; ?>
                    <?php foreach(require APP_PATH . 'includes/l/pixels.php' as $item): ?>
                        <div class="col-6 col-lg-4 p-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                            <div class="bg-gray-100 rounded-3x w-100 p-3 icon-zoom-animation text-truncate">
                                <i class="<?= $item['icon'] ?> fa-fw fa-lg mx-1" style="color: <?= $item['color'] ?>"></i>
                                <span class="h6"><?= $item['name'] ?></span>
                            </div>
                        </div>
                        <?php $i++ ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if(settings()->main->display_index_testimonials): ?>
    <div class="my-5">&nbsp;</div>

    <div class="p-4 mt-5">
        <div class="py-7 bg-primary-100 rounded-2x">
            <div class="container">
                <div class="text-center">
                    <h2><?= l('index.testimonials.header') ?> <i class="fas fa-fw fa-xs fa-check-circle text-primary"></i></h2>
                </div>

                <div class="row mt-8">
                    <?php foreach(['one', 'two', 'three'] as $key => $value): ?>
                        <div class="col-12 col-lg-4 mb-6 mb-lg-0" data-aos="fade-up" data-aos-delay="<?= $key * 100 ?>">
                            <div class="card border-0 zoom-animation-subtle">
                                <div class="card-body">
                                    <img src="<?= ASSETS_FULL_URL . 'images/index/testimonial-' . $value . '.jpeg' ?>" class="img-fluid index-testimonial-avatar" alt="<?= l('index.testimonials.' . $value . '.name') . ', ' . l('index.testimonials.' . $value . '.attribute') ?>" loading="lazy" />

                                    <p class="mt-5">
                                        <span class="text-gray-800 font-weight-bold text-muted h5">“</span>
                                        <span><?= l('index.testimonials.' . $value . '.text') ?></span>
                                        <span class="text-gray-800 font-weight-bold text-muted h5">”</span>
                                    </p>

                                    <div class="blockquote-footer mt-4">
                                        <span class="font-weight-bold"><?= l('index.testimonials.' . $value . '.name') ?></span>, <span class="text-muted"><?= l('index.testimonials.' . $value . '.attribute') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if(settings()->main->display_index_plans): ?>
    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="text-center mb-5">
            <h2><?= l('index.pricing.header') ?></h2>
            <p class="text-muted"><?= l('index.pricing.subheader') ?></p>
        </div>

        <?= $this->views['plans'] ?>
    </div>
<?php endif ?>

<?php if(settings()->main->display_index_faq): ?>
    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="text-center mb-5">
            <h2><?= sprintf(l('index.faq.header'), '<span class="text-primary">', '</span>') ?></h2>
        </div>

        <div class="accordion index-faq" id="faq_accordion">
            <?php foreach(['one', 'two', 'three', 'four'] as $key): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="" id="<?= 'faq_accordion_' . $key ?>">
                            <h3 class="mb-0">
                                <button class="btn btn-lg font-weight-bold btn-block d-flex justify-content-between text-gray-800 px-0 icon-zoom-animation" type="button" data-toggle="collapse" data-target="<?= '#faq_accordion_answer_' . $key ?>" aria-expanded="true" aria-controls="<?= 'faq_accordion_answer_' . $key ?>">
                                    <span><?= l('index.faq.' . $key . '.question') ?></span>

                                    <span data-icon>
                                        <i class="fas fa-fw fa-circle-chevron-down"></i>
                                    </span>
                                </button>
                            </h3>
                        </div>

                        <div id="<?= 'faq_accordion_answer_' . $key ?>" class="collapse text-muted mt-2" aria-labelledby="<?= 'faq_accordion_' . $key ?>" data-parent="#faq_accordion">
                            <?= l('index.faq.' . $key . '.answer') ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <?php ob_start() ?>
    <script>
        'use strict';

        $('#faq_accordion').on('show.bs.collapse', event => {
            let svg = event.target.parentElement.querySelector('[data-icon] svg')
            svg.style.transform = 'rotate(180deg)';
            svg.style.color = 'var(--primary)';
        })

        $('#faq_accordion').on('hide.bs.collapse', event => {
            let svg = event.target.parentElement.querySelector('[data-icon] svg')
            svg.style.color = 'var(--primary-800)';
            svg.style.removeProperty('transform');
        })
    </script>
    <?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
<?php endif ?>

<?php if(settings()->users->register_is_enabled): ?>
    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-3xl shadow-lg overflow-hidden" data-aos="fade-up">
            <div class="p-5 p-lg-6">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-lg-5">
                        <div class="text-center text-lg-left mb-4 mb-lg-0">
                            <h2 class="h1 text-white mb-3"><?= l('index.cta.header') ?></h2>
                            <p class="h5 text-white-80 mb-0"><?= l('index.cta.subheader') ?></p>
                        </div>
                    </div>

                    <div class="col-12 col-lg-5 mt-4 mt-lg-0">
                        <div class="text-center text-lg-right">
                            <?php if(\Altum\Authentication::check()): ?>
                                <a href="<?= url('dashboard') ?>" class="btn btn-gradient-primary text-white px-5 py-3 rounded-pill font-weight-bold shadow-lg zoom-animation" style="background: linear-gradient(45deg, #667eea, #764ba2); border: none;">
                                    <i class="fas fa-tachometer-alt me-2"></i> <?= l('dashboard.menu') ?> <i class="fas fa-fw fa-arrow-right ms-2"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?= url('register') ?>" class="btn btn-gradient-primary text-white px-5 py-3 rounded-pill font-weight-bold shadow-lg zoom-animation" style="background: linear-gradient(45deg, #667eea, #764ba2); border: none;">
                                    <i class="fas fa-user-plus me-2"></i> <?= l('index.cta.register') ?> <i class="fas fa-fw fa-arrow-right ms-2"></i>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>


<?php if(count($data->blog_posts)): ?>
    <div class="my-5">&nbsp;</div>

    <div class="container">
        <div class="text-center mb-5">
            <h2><?= sprintf(l('index.blog.header'), '<span class="text-primary">', '</span>') ?></h2>
        </div>

        <div class="row">
            <?php foreach($data->blog_posts as $blog_post): ?>
                <div class="col-12 col-lg-4 p-4">
                    <div class="card h-100 zoom-animation-subtle">
                        <div class="card-body">
                            <?php if($blog_post->image): ?>
                                <a href="<?= SITE_URL . ($blog_post->language ? \Altum\Language::$active_languages[$blog_post->language] . '/' : null) . 'blog/' . $blog_post->url ?>" aria-label="<?= $blog_post->title ?>">
                                    <img src="<?= \Altum\Uploads::get_full_url('blog') . $blog_post->image ?>" class="blog-post-image-small img-fluid w-100 rounded mb-4" alt="<?= $blog_post->image_description ?>" loading="lazy" />
                                </a>
                            <?php endif ?>

                            <a href="<?= SITE_URL . ($blog_post->language ? \Altum\Language::$active_languages[$blog_post->language] . '/' : null) . 'blog/' . $blog_post->url ?>">
                                <h3 class="h5 card-title mb-2"><?= $blog_post->title ?></h3>
                            </a>

                            <p class="text-muted mb-0"><?= $blog_post->description ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?>


<?php ob_start() ?>
<link rel="stylesheet" href="<?= ASSETS_FULL_URL . 'css/libraries/aos.min.css?v=' . PRODUCT_CODE ?>">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<?php ob_start() ?>
<script src="<?= ASSETS_FULL_URL . 'js/libraries/aos.min.js?v=' . PRODUCT_CODE ?>"></script>

<script>
    AOS.init({
        delay: 100,
        duration: 600
    });
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
