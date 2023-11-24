<style>
  .page-item.active .page-link {
    background-color: #fe4c50 !important;
    border-color: #fe4c50 !important;
}
.page-link {
  color: #51545f !important ;
}
</style>

<nav aria-label="...">
  <ul class="pagination" style="justify-content: center; padding-top: 40px;">
    <?php
    $cateIdParam = isset($CateId) ? "&CateId=$CateId" : '';
    ?>

    <?php if ($current_page > 1) { ?>
      <li class="page-item" disabled>
        <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $current_page - 1 ?><?= $cateIdParam; ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
    <?php } ?>

    <?php for ($num = 1; $num <= $totalPage; $num++) { ?>
      <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
        <li class="page-item <?= $num == $current_page ? 'active' : '' ?>">
          <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?><?= $cateIdParam; ?>"><?= $num ?></a>
        </li>
      <?php } ?>
    <?php } ?>

    <?php if ($current_page < $totalPage) { ?>
      <li class="page-item">
        <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $current_page + 1 ?><?= $cateIdParam; ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>
