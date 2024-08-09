<!-- File: views/templates/admin/import_progress.tpl -->
<div id="import_progress">
    <h3>{$smarty.translate s='Importing XML...'}</h3>
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {$progress_percentage}%;" aria-valuenow="{$progress_percentage}" aria-valuemin="0" aria-valuemax="100">{$progress_percentage}%</div>
    </div>
    <div id="import_details">
        <!-- Display details like which product is currently being processed -->
        {$smarty.translate s='Processing product'}: {$current_product}
    </div>
</div>
