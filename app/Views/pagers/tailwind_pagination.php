<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="flex items-center justify-center space-x-1 my-4">

        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getFirst() ?>" aria-label="First" class="px-3 py-1.5 rounded-lg bg-white border border-slate-300 text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">
                    <span aria-hidden="true"><i class="fa-solid fa-angles-left"></i></span>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getPrevious() ?>" aria-label="Previous" class="px-3 py-1.5 rounded-lg bg-white border border-slate-300 text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">
                    <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li>
                <a href="<?= $link['uri'] ?>" class="px-3 py-1.5 rounded-lg border text-sm font-medium transition-colors <?= $link['active'] ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-slate-300 text-slate-600 hover:bg-slate-50' ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li>
                <a href="<?= $pager->getNext() ?>" aria-label="Next" class="px-3 py-1.5 rounded-lg bg-white border border-slate-300 text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">
                    <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>" aria-label="Last" class="px-3 py-1.5 rounded-lg bg-white border border-slate-300 text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">
                    <span aria-hidden="true"><i class="fa-solid fa-angles-right"></i></span>
                </a>
            </li>
        <?php endif ?>

    </ul>
</nav>