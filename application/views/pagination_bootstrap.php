<ul class="pagination pagination-md justify-content-center my-2 px-2">
    <?php if ($total_pages > 1): ?>
        <!-- Previous Button -->
        <?php if ($current_page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '/' . ($current_page - 1); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                <?php if ($i == $current_page): ?>
                    <span class="page-link"><?php echo $i; ?></span>
                <?php else: ?>
                    <a class="page-link" href="<?php echo $base_url . '/' . $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <!-- Next Button -->
        <?php if ($current_page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '/' . ($current_page + 1); ?>" aria-label="Next">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">Next &raquo;</span>
            </li>
        <?php endif; ?>
    <?php endif; ?>
</ul>
