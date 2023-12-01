<div id="portfolio">
<?php
$result = $mysqli->query("SELECT * FROM projects WHERE projectpublished = 1");

while ($row = $result->fetch_assoc()) {
    ?>
    <div class="project">
        <div class="projectimage">
            <img src="<?php echo $row["projectimageurl"];?>" />
        </div>
        <div class="projectinfo">
            <a href="<?php echo $row["projectsiteurl"];?>" class="projectname"><?php echo $row["projectname"];?></a>
            <div class="projectperiod"><?php echo date("M Y", $row["projectstart"]) . (is_null($row["projectend"])?"":" - ".date("M Y", $row["projectend"]));?></div>
            <div class="projectintro"><?php echo $row["projectintro"];?></div>
            <div class="tags">
                <?php
                    $stmt = $mysqli->prepare("SELECT tagname FROM projecttags, tags WHERE projecttags.tagid=tags.tagid AND projecttags.projectid = ?");
                    $stmt->bind_param("i", $row["projectid"]);
                    $stmt->execute();
                    $tagresult = $stmt->get_result();

                    while ($tagrow = $tagresult->fetch_assoc()) {
                        ?><span class="tag"><?php echo $tagrow["tagname"]; ?></span><?php
                    }

                ?>
            </div>
        </div>
    </div>
    <?php
}
?>
</div>