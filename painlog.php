<?php
session_start();
if (!isset($_SESSION['details'])) {
    header('location: index.php');
}
require_once "header.php"; ?>
<div class="container">
    <div class="top-header">
        <b>Welcome <?php echo $_SESSION['details']['name'] ?></b> <br>
        You are here > Pain Log
    </div>
    <div class="content">
        <?php require_once 'handlers/alerts.php'; ?>
        <div style="width: 50%; height: auto; display: inline-block; vertical-align: top;">
            <form action="handlers/painlog/log.php" method="post">
                <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                    <label> Start Time </label>
                    <input type="text" class="dates" name="start_time" required>
                </div>
                <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                    <label> End Time </label>
                    <input type="text" class="dates" name="end_time" required>
                </div>
                <div style="width: 96%; margin: 10px 0; padding: 5px 10px; display: block;">
                    <label> Pain Scale </label>
                    <input type="text" class="js-range-slider" name="scale" value="" />
                </div>
                <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                    <label> Activities causing the pain </label>
                    <input type="text" name="trigger" required>
                </div>
                <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                    <label> Location </label>
                    <select name="location" required>
                        <option value="" selected> -- select </option>
                        <option value="Head"> Head </option>
                        <option value="Abdomen"> Abdomen </option>
                        <option value="Neck"> Neck </option>
                        <option value="Left Hand"> Left Hand </option>
                        <option value="Right Hand"> Right Hand </option>
                        <option value="Left Leg"> Left Leg </option>
                        <option value="Right Leg"> Right Leg </option>
                        <option value="Breast"> Breast </option>
                        <option value="Ear"> Ear </option>
                        <option value="Pelvis"> Pelvis </option>
                    </select>
                </div>
                <div style="width: 96%; margin: 10px 0; padding: 5px 10px; display: block;">
                    <label> Description </label>
                    <textarea name="description" required></textarea>
                </div>
                <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                    <input type="submit" value="SUBMIT">
                </div>
            </form>
        </div>
        <div style="width: 40%; height: auto;  display: inline-block; vertical-align: top; text-align: right">
            <img src="image/scale.png">
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
    $(".js-range-slider").ionRangeSlider({
        min: 0,
        max: 10,
        from: 0,
        grid_margin: true,
        grid_num: 10,
        grid_snap: false,
        step: 1,
        grid: true
    });
</script>
<script>
    flatpickr(".dates", {
        enableTime: true,
        noCalendar: true,
    });
</script>
<?php require_once "footer.php"; ?>