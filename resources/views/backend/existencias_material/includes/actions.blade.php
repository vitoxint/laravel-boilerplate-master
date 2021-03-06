
        

<div class="btn-group btn-group-sm" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        <a href="{{ route('admin.existencia_material.edit', $existencia) }}" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ajustar">
            <i class="fas fa-sliders-h"></i>
        </a>
       

@if($existencia->estado_consumo == 1)
        <a href="{{ route('admin.existencia_material.destroy', $existencia) }}"
           data-method="delete"
           data-trans-button-cancel="@lang('buttons.general.cancel')"
           data-trans-button-confirm="@lang('buttons.general.crud.delete')"
           data-trans-title="@lang('strings.backend.general.are_you_sure')"
           class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')">
           <i class="fas fa-trash"></i>
        </a>

@endif
 </div>