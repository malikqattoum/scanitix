<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<div class="card mb-5">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-4">
            <h2 class="h4 text-truncate mb-0"><i class="fas fa-fw fa-qrcode fa-xs text-primary-900 mr-2"></i> <?= l('admin_qr_codes.header') ?></h2>

            <div>
                <span class="badge <?= $data->total['qr_codes'] > 0 ? 'badge-success' : 'badge-secondary' ?>"><?= ($data->total['qr_codes'] > 0 ? '+' : null) . nr($data->total['qr_codes']) ?></span>
            </div>
        </div>

        <div class="chart-container <?= $data->total['qr_codes'] ? null : 'd-none' ?>">
            <canvas id="qr_codes"></canvas>
        </div>
        <?= $data->total['qr_codes'] ? null : include_view(THEME_PATH . 'views/partials/no_chart_data.php', ['has_wrapper' => false]); ?>
    </div>
</div>

<?php $html = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    'use strict';

    let color = css.getPropertyValue('--primary');
    let color_gradient = null;

    /* Display chart */
    let qr_codes_chart = document.getElementById('qr_codes').getContext('2d');
    color_gradient = qr_codes_chart.createLinearGradient(0, 0, 0, 250);
    color_gradient.addColorStop(0, set_hex_opacity(color, 0.1));
    color_gradient.addColorStop(1, set_hex_opacity(color, 0.025));

    new Chart(qr_codes_chart, {
        type: 'line',
        data: {
            labels: <?= $data->qr_codes_chart['labels'] ?>,
            datasets: [
                {
                    label: <?= json_encode(l('admin_qr_codes.title')) ?>,
                    data: <?= $data->qr_codes_chart['qr_codes'] ?? '[]' ?>,
                    backgroundColor: color_gradient,
                    borderColor: color,
                    fill: true
                }
            ]
        },
        options: chart_options
    });
</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
