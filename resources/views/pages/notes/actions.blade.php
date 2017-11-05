@if($note->active == 1)
    <a href="{{ url('/notes/'.$note->id.'/disable') }}"
       class="btn btn-light disable-note text-black"
       data-toggle="tooltip" data-placement="top" title="Zablokuj"><i
                class="fa fa-ban"></i></a>
    <a href="{{ url('/notes/'.$note->id) }}" class="btn btn-light text-black"
       data-toggle="tooltip"
       data-placement="top" title="Podgląd"><i class="fa fa-eye"></i></a>
    <a href="{{ url('/notes/'.$note->id.'/edit') }}" class="btn btn-light text-black"
       data-toggle="tooltip"
       data-placement="top" title="Edycja"><i class="fa fa-edit"></i></a>
    <a href="#" data-id="{{ $note->id }}" type="button"
       class="btn btn-light delete-note text-black"
       data-toggle="tooltip" data-placement="top" title="Usuń"><i
                class="fa fa-trash"></i></a>
@else
    <a href="{{ url('/notes/'.$note->id.'/enable') }}"
       class="btn btn-light enable-note text-black"
       data-toggle="tooltip" data-placement="top" title="Odblokuj"><i
                class="fa fa-unlock-alt"></i></a>
@endif