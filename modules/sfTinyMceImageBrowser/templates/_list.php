<ul class="images">
<?php foreach ($images as $image) : ?>
  <li>
    <a href="#" onclick="sfTinyMceImageBrowser_select('<?php echo $image->getWebPath() ?>')">
      <?php echo image_tag($image->getResizedWebPath(75, 75)) ?>
      <span class="name">
        <?php echo $image->getName() ?>
      </span>
      <span class="size">
        <?php echo $image->getWidth() ?>px / <?php echo $image->getHeight() ?>px
      </span>
    </a>
  </li>
<?php endforeach; ?>
</ul>