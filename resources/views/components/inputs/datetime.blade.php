@props(['id', 'name', 'label', 'value_date', 'value_time', 'required' => false, 'class' => ''])
<div class="{{ $class ?? '' }}">
    <label class="sr-only" for="{{ $id ."_date" }}">{{ $label }}</label><br>
    <input type="date" aria-description="Datum eingeben Format: TT.MM.JJJJ" id="{{ $id ."_date" }}"
        name="{{ $name }}_date" value="{{ $value_date }}"
        @if (isset($required)) required @else @endif>
    <label class="sr-only" for="{{ $id . "_time" }}">{{ $label }}</label>
    <input type="time" aria-description="Uhrzeit eingeben Format: HH:MM" id="{{ $id . "_time" }}"
        name="{{ $name }}_time" value="{{ $value_time }}"
        @if (isset($required)) required @else @endif>
</div>
