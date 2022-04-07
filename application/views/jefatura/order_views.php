<h2>Lista</h2> 
<table>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['name'];?></td>
        </tr>
    <?php endforeach; ?>
</table>