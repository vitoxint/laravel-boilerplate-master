<div class="btn-group btn-group-sm float-right" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">


        <a href="{{ route('admin.imagen_itemot.destroy', $imagen) }}"
           data-method="delete"
           data-trans-button-cancel="@lang('buttons.general.cancel')"
           data-trans-button-confirm="@lang('buttons.general.crud.delete')"
           data-trans-title="@lang('strings.backend.general.are_you_sure')"
           class="btn btn-default" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')">
            <i class="fas fa-times"></i>
        </a>
    </div>






