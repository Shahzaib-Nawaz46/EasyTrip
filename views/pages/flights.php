<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="spacer-after-hero" style="height: 100px;"></div>

<div class="container section-padding">
    <h2 class="section-title">Flight Search Results</h2>
    
    <!-- Travelpayouts Widgets -->
    <div id="tpwl-search" style="margin-bottom: 2rem;"></div>
    <div id="tpwl-tickets"></div>
</div>

<!-- Travelpayouts Script -->
<script
    data-noptimize="1"
    data-cfasync="false"
    data-wpfc-render="false"
    seraph-accel-crit="1"
    data-no-defer="1">
    (function () {
        var script = document.createElement("script");
        script.async = true;
        script.type = "module";
        script.src = "https://tpemb.com/wl_web/main.js?wl_id=19335";
        document.head.appendChild(script);
    })();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
