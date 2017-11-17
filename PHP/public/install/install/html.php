<iframe src="action/one.php?active=one"></iframe>
<style>* {
        margin: 0;
        padding: 0;
        border: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }</style>
<script>
    function ok(a) {
        if (a) {
            window.location = "../../index.php/" + a;
        } else {
            window.location = "../../index.php";
        }
    }
</script>