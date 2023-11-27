<nav aria-label="...">
  <ul class="pagination" style="float: right;">
    <?php if ($current_page > 1){ ?>
      <li class="page-item" disabled>
        <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $current_page - 1 ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
    <?php } ?>

    <?php for ($num = 1; $num <= $totalPage; $num++){ ?>
      <?php if ($num > $current_page - 3 && $num < $current_page + 3){?>
        <li class="page-item <?= $num == $current_page ? 'active' : '' ?>" >
            <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
        </li>
        <?php }?>  
    <?php } ?>
        
    <?php if ($current_page < $totalPage){ ?>
      <li class="page-item">
        <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $current_page + 1 ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>
