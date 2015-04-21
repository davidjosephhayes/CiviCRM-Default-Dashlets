{* HEADER *}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>

{foreach from=$groups item=group}

	<h3>{$group.name}</h3>

	{foreach from=$avalabledashlets item=avalabledashlet}
	
		<input type="checkbox" value="1" name="defaultdashlets[{$group.id}][{$avalabledashlet.id}]"> {$avalabledashlet.label} &nbsp;&nbsp;&nbsp;
	
	{/foreach}

{/foreach}


{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
