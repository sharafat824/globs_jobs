<style>
.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    border-color: #dda63a !important;
}
</style>
<ul class="pagination pagination-md justify-content-center my-2 px-2">
    <?php if ($total_pages > 1): ?>
        <!-- Previous Button -->
        <?php if ($current_page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '/' . ($current_page - 1); ?>" aria-label="Previous" style="background-color: #ffc956; color: #fff;">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true" style="background-color: #ffc956; color: #fff;">&laquo; Previous</span>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php 
            $group_size = 10; 
            $start = max(1, floor(($current_page - 1) / $group_size) * $group_size + 1);
            $end = min($start + $group_size - 1, $total_pages);
        ?>
        
        <?php if ($start > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '/' . ($start - 1); ?>" style="background-color: #ffc956; color: #fff;">...</a>
            </li>
        <?php endif; ?>
        
        <?php for ($i = $start; $i <= $end; $i++): ?>
            <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                <?php if ($i == $current_page): ?>
                    <span class="page-link" style="background-color: #ffc956; color: #fff;"><?php echo $i; ?></span>
                <?php else: ?>
                    <a class="page-link" href="<?php echo $base_url . '/' . $i; ?>" style="background-color: #ffc956; color: #fff;"><?php echo $i; ?></a>
                <?php endif; ?>
            </li>
        <?php endfor; ?>
        
        <?php if ($end < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '/' . ($end + 1); ?>" style="background-color: #ffc956; color: #fff;">...</a>
            </li>
        <?php endif; ?>

        <!-- Next Button -->
        <?php if ($current_page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '/' . ($current_page + 1); ?>" aria-label="Next" style="background-color: #ffc956; color: #fff;">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true" style="background-color: #ffc956; color: #fff;">Next &raquo;</span>
            </li>
        <?php endif; ?>
    <?php endif; ?>
</ul>