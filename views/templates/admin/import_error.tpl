<!-- File: views/templates/admin/import_error.tpl -->
<div id="import_error">
    <h3>{$smarty.translate s='XML Import Errors'}</h3>
    <div class="alert alert-danger">
        <ul>
            {foreach from=$errors item=error}
                <li>{$error}</li>
            {/foreach}
        </ul>
    </div>
    <div>
        <a href="{$link->getAdminLink('AdminXmlImport')}" class="btn btn-primary">{$smarty.translate s='Try Again'}</a>
    </div>
</div>
