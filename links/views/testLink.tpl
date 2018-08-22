<div class="container">
    <h4 class="text-center">Created links:</h4>
    <table class="table">
        <tr>
        <th scope="col">№</th>
        <th scope="col">URL</th>
        <th scope="col">Short URL</th>
        </tr>
        <?php if (!empty($list)) {
        while($row = mysqli_fetch_assoc($list)) { ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['url'] ?></td>
            <td><a href="<?php echo $row['short_url'] ?>"><?php echo $row['short_url'] ?></td>
        </tr>
        <?php } }?>
    </table>
</div>

