@props(['link', 'mailLink'])
<div class="row">
    <div class="col-md-6 col-12">
        <a class="component-button btn-primary btn text-start mb-3" href="{{ $link }}" target="_blank">
            <i class="fas fa-arrow-right pe-3"></i>Zum Meeting</a>
    </div>
    <div class="col-12 col-md-6">
        <a class="component-button btn-secondary btn text-start mb-3" data-bs-toggle="tooltip"
            data-bs-title="Der Link wurde in die Zwischenablage kopiert!" data-bs-trigger="click" data-bs-placement="top"
            onclick="event.preventDefault(); navigator.clipboard.writeText(this.getAttribute('href')); setTimeout(() => {bootstrap.Tooltip.getOrCreateInstance(this).hide()}, 2000) "
            href="{{ $link }}" target="_blank">
            <i class="fas fa-copy pe-3"></i>Link kopieren</a>
    </div>
    <div class="col-12 col-md-6">
        <a href="#" class="component-button btn btn-secondary text-start"
            hx-get="{{ $mailLink }}"
            hx-target="#modalcontainer" class="mail"><i class="fas fa-envelope pe-3"></i>Mailvorlage
            erzeugen</a>
    </div>
</div>
