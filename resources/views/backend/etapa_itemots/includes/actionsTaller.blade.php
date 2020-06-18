
        

<div class="btn-group btn-group-sm" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">

    @if($etapaItemOt->estado_avance == 1)
        <a href="{{ route('admin.etapa_itemots.comenzar', $etapaItemOt) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Comenzar">
            <i class="fas fa-play"></i> 
        </a>
    @endif

    @if($etapaItemOt->estado_avance == 2 || $etapaItemOt->estado_avance == 3)
        <a href="{{ route('admin.etapa_itemots.terminar', $etapaItemOt) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Terminar">
            <i class="fas fa-check"></i> 
        </a>
    @endif
       
<!-- 
        <a href="{{ route('admin.etapa_itemots.destroy', $etapaItemOt) }}"
           data-method="delete"
           data-trans-button-cancel="@lang('buttons.general.cancel')"
           data-trans-button-confirm="@lang('buttons.general.crud.delete')"
           data-trans-title="@lang('strings.backend.general.are_you_sure')"
           class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')">
           <i class="fas fa-trash"></i>
        </a> -->
        
 </div>