<div class="visually-hidden-focusable">
    @foreach($menuItems as $id => $text)
    <a href="#{{ $id }}" class="outline mr-3">{{ $text }}</a>
    @endforeach
</div>
