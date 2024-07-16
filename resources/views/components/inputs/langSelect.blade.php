<div area-hidden="true" class="component-select-element as-language" data-type="component">
    <select aria-describedby="sprachwahl-desc" name="sprachwahl" id="sprachwahl" aria-label="Sprachauswahl"
        aria-describedby="sprachwahl-desc" class="component component-select" data-type="component" onchange="">
        <option value="de-ES" @if (session('language', 'de-DE') == 'de-ES') selected="selected" @endif>Einfache Sprache</option>
        <option value="de-DE" @if (session('language', 'de-DE') == 'de-DE') selected="selected" @endif>Alltagssprache</option>
    </select>
    <span area-hidden="true" style="display:none;" id="sprachwahl-desc">Hier kann zwischen leicht lesbarer Sprache und
        Alltagssprache gewechselt werden</span>
</div>
<script>
    document.getElementById('sprachwahl').addEventListener('change', function() {
        window.location.href = "{{ route('switchLanguage', ['language' => '']) }}/" + this.value;
    });
</script>
