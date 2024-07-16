@props([
'elementTitleText' => 'Vorschau',
'previewType' => 'text',
'value' => '0'
])
<div class="preview-title">{{$elementTitleText}}</div>
<div class="preview-display {{$previewType}}">
    <div class="{{$previewType}}" id="previewFontSize">
        @if ($previewType == 'text')
            <div id="previewFontSize">
                Lorem-ipsum dolor sit amet
            </div>
        @endif
        @if ($previewType == 'icon')
            <div id="previewIconSize">
                <i class="fa-solid fa-microphone-slash"></i>
            </div>
        @endif
    </div>
</div>
<script type="text/javascript">
    @if ($previewType === 'text')
        function updateFontSize(value) {
            switch (value) {
                case '0':
                    var fontSize = '75%';
                    break;
                case '1':
                    var fontSize = '100%';
                    break;
                case '2':
                    var fontSize = '125%';
                    break;
                default:
                    var fontSize = '100%';
            }
            var text = document.getElementById('previewFontSize');
            text.style.fontSize = fontSize;
        }
    @endif
    @if ($previewType === 'icon')
        function updateIconSize(value) {
            switch (value) {
                case '0':
                    var fontSize = '75%';
                    break;
                case '1':
                    var fontSize = '100%';
                    break;
                case '2':
                    var fontSize = '125%';
                    break;
                default:
                    var fontSize = '100%';
            }
            var text = document.getElementById('previewIconSize');
            text.style.fontSize = fontSize;
        }
    @endif
    document.addEventListener("DOMContentLoaded", (event) => {
        @if ($previewType === 'text')
            updateFontSize('{{$value}}');
        @endif
        @if ($previewType === 'icon')
            updateIconSize('{{$value}}');
        @endif
    })
</script>


