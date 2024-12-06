<style>
    /* General Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        padding: 10px 0;
        list-style: none;
        border-radius: 5px;
        background-color: #f8f9fa;
    }

    .page-item {
        margin: 0 5px;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        font-size: 14px;
        font-weight: 500;
        color: #343a40;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #fff;
        transition: all 0.3s ease;
    }

    /* Hover Effects */
    .page-link:hover {
        color: #fff;
        background-color: #e0a800; /* Bootstrap Primary Color */
        border-color: #e0a800;
    }

    /* Active Page */
    .page-item.active .page-link {
        color: #fff;
        background-color: #e0a800; /* Active State Color */
        border-color: #e0a800;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Disabled State */
    .page-item.disabled .page-link {
        color: #ccc;
        background-color: #f8f9fa;
        border-color: #ddd;
        pointer-events: none;
        cursor: not-allowed;
    }

    /* Responsive Spacing */
    @media (max-width: 576px) {
        .page-link {
            font-size: 12px;
            padding: 6px 10px;
        }
    }
</style>

<ul class="pagination">
    <?php if ($total_pages > 1): ?>
        <!-- Previous Button -->
        <?php if ($current_page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '&page=' . ($current_page - 1); ?>" aria-label="Previous">
                    &laquo; Previous
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo; Previous</span>
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
                <a class="page-link" href="<?php echo $base_url . '&page=' . ($start - 1); ?>">...</a>
            </li>
        <?php endif; ?>
        
        <?php for ($i = $start; $i <= $end; $i++): ?>
            <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                <?php if ($i == $current_page): ?>
                    <span class="page-link"><?php echo $i; ?></span>
                <?php else: ?>
                    <a class="page-link" href="<?php echo $base_url . '&page=' . $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            </li>
        <?php endfor; ?>
        
        <?php if ($end < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '&page=' . ($end + 1); ?>">...</a>
            </li>
        <?php endif; ?>

        <!-- Next Button -->
        <?php if ($current_page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $base_url . '&page=' . ($current_page + 1); ?>" aria-label="Next">
                    Next &raquo;
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">Next &raquo;</span>
            </li>
        <?php endif; ?>
    <?php endif; ?>
</ul>
