<pre>
<?php
/**
 * @var int $id
 */
$history = new \app\core\debt\DebtHistory();
print_r($history->findOne(['history_id' => $id]));
$histories = $history->findOne(['history_id' => $id]);
?>
</pre>


