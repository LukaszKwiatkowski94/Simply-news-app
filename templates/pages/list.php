<section class="section news-list-admin">	
    <table class="news-list-admin__tabel">
        <thead>
            <th>Title</th>
            <th>Active</th>
            <th>Date Created</th>
            <th>Date Updated</th>
            <th>Options</th>
        </thead>
        <tbody>
            <?php foreach($params['news'] as $news): ?>
            <tr>
                <th><?php echo $news['title'] ?></th>
                <th><?php
            if($news['active']==1)
            {
                echo 'Active';
            } else {
                echo 'Inactive';
            } ?></th>
                <th><?php echo $news['date_created'] ?></th>
                <th><?php echo $news['date_last_updated'] ?></th>
                <th>
                    <a class="news-list-admin__link" href="/news-show/<?php echo $news['id']; ?>">Show</a>
                    <a class="news-list-admin__link" href="/news-edit/<?php echo $news['id']; ?>">Edit</a>
                    <a class="news-list-admin__link" href="/news-delete/<?php echo $news['id']; ?>">Delete</a>
                </th>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
	
</section>
