<!-- Import XML Form -->
<form action="{$link->getAdminLink('AdminXmlImport')}" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>{$smarty.translate s='Import XML'}</legend>
        
        <!-- XML Feed URL Input -->
        <label>{$smarty.translate s='XML Feed URL'}</label>
        <div class="margin-form">
            <input type="text" name="xmlFeedUrl" size="40" value="{$xmlFeedUrl|escape:'html':'UTF-8'}">
        </div>

        <!-- Mapping of XML Fields to PrestaShop Fields -->
        <label>{$smarty.translate s='Map XML Fields to PrestaShop Fields'}</label>
        <div class="margin-form">
            <table>
                <tr>
                    <th>{$smarty.translate s='XML Field'}</th>
                    <th>{$smarty.translate s='PrestaShop Field'}</th>
                </tr>
                {foreach from=$available_fields item=field key=xmlField}
                <tr>
                    <td>{$xmlField|escape:'html':'UTF-8'}</td>
                    <td>
                        <select name="mapping[{$xmlField|escape:'html':'UTF-8'}]">
                            {foreach from=$prestashop_fields item=psField}
                            <option value="{$psField|escape:'html':'UTF-8'}">{$psField|escape:'html':'UTF-8'}</option>
                            {/foreach}
                        </select>
                    </td>
                </tr>
                {/foreach}
            </table>
        </div>

        <!-- Submit Button -->
        <div class="margin-form">
            <input type="submit" name="submitXmlImport" value="{$smarty.translate s='Import'}" class="button">
        </div>
    </fieldset>
</form>
