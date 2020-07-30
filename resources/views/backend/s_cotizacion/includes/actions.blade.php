
        

<div class="btn-group btn-group-sm" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        <a href="{{ route('admin.s_cotizaciones.edit', $cotizacion) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('admin.s_cotizaciones.print', $cotizacion) }}" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Imprimir PDF">
            <i class="fas fa-file-pdf" style="color:red;"></i>
        </a>

        <a href="{{ route('admin.s_cotizaciones.send', $cotizacion) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Enviar cotización"
                name="confirm_item"
                data-trans-button-cancel="@lang('buttons.general.cancel')"
                data-trans-button-confirm="@lang('buttons.general.continue')"
                data-trans-title="@lang('strings.backend.general.are_you_sure')">
            <i class="fas fa-envelope" style="color:white;"></i>
        </a>

<!--         <a href="{{ route('admin.cotizaciones.destroy', $cotizacion) }}"
           data-method="delete"
           data-trans-button-cancel="@lang('buttons.general.cancel')"
           data-trans-button-confirm="@lang('buttons.general.crud.delete')"
           data-trans-title="@lang('strings.backend.general.are_you_sure')"
           class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')">
           <i class="fas fa-trash"></i>
        </a> -->
 </div>