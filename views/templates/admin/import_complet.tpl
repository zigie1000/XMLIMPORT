<!-- File: views/templates/admin/import_complete.tpl -->
<div id="import_complete">
    <h3>{$smarty.translate s='XML Import Complete'}</h3>
    <p>{$smarty.translate s='Successfully imported'}: {$successful_imports} {$smarty.translate s='products'}</p>
    {if $errors}
        <div class="alert alert-danger">
            <h4>{$smarty.translate s='Errors during import:'}</h4>
            <ul>
                {foreach from=$errors item=error}
                    <li>{$error}</li>
                {/foreach}
            </ul>
        </div>
    {/if}
    <div>
        <a href="{$link->getAdminLink('AdminXmlImport')}" class="btn btn-primary">{$smarty.translate s='Start New Import'}</a>
    </div>
</div>
