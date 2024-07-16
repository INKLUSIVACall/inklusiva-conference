<?php

return [
    'index.title' => 'Meetings',
    'index.desc' => 'Hier befindet sich eine Übersicht über alle Meetings, die Sie gerade geplant haben. Sie haben hier Zugriff auf Details und Einladungslinks für das Meeting. Sie können auch direkt als Moderator an einem Meeting teilnehmen. Sie können das Meeting ändern oder das Meeting löschen.',
    'successTitle' => 'Erfolg!',
    'create.pageTitle' => 'Meeting anlegen',
    'create.pageFormat' => 'h1',
    'create.pageDesc' => 'Auf dieser Seite können Sie ein neues Meeting erstellen. Sie müssen einen Titel und einen Start-Zeitpunkt für das Meeting festlegen. Sie können aber auch ein dauerhaftes Meeting anlegen. Dann brauchen Sie keine Start-Zeit. Sie können zudem festlegen, ob eine Aufzeichnung geplant ist und ob eine Unterstützung durch Schrift- und/oder DGS-Dolmetschende vorgesehen ist.',
    'create.pageHelpLink' => 'javascript:void(0)',
    'create.titleAndDate.ariaLabel' => 'Titel und Start-Zeitpunkt festlegen',
    'create.titleAndDate.legend' => 'Titel und Start-Zeitpunkt',
    'create.titleAndDate.title.titleText' => 'Titel des Meetings',
    'create.titleAndDate.title.desc' => 'Dieser Titel wird den Teilnehmer*innen des Meetings als Name der Veranstaltung angezeigt',
    'create.titleAndDate.title.placeholder' => 'Bitte geben Sie einen Titel ein',
    'create.titleAndDate.date.headline' => 'Datum und Uhrzeit',
    'create.titleAndDate.date.label' => 'Datum und Uhrzeit',
    'create.titleAndDate.date.desc' => 'Stellen Sie hier bitte einen Tag und eine Uhrzeit ein, an dem das Meeting stattfinden und starten soll. Das eingestellte Datum und die Zeit werden den Teilnehmenden dann als Start-Zeitpunkt des Meetings angezeigt.',
    'create.recording.legend' => 'Aufzeichnung',
    'create.recording.titleText' => 'Meeting mit Aufzeichnung',
    'create.recording.desc' => 'Wenn Sie diesen Schalter einschalten, wird das Meeting aufgezeichnet. Jede*r Teilnehmer*in kann der Aufzeichnung vor, während und am Ende des Meetings widersprechen. In diesem Fall wird die Aufzeichnung sofort entfernt und steht nicht im Backend zur Verfügung. Falls alle Teilnehmenden der Aufzeichnung zustimmen, steht die Aufzeichnung nach dem Meeting im Backend zur Verfügung. Sie kann dann manuell an die Teilnehmenden versendet werden.',
    'create.signLang.ariaLabel' => 'Zugang für DGS-Dolmetschende anlegen',
    'create.signLang.legend' => 'DGS-Dolmetschung',
    'create.signLang.titleText' => 'DGS-Dolmetschung',
    'create.signLang.desc' => 'Wenn Sie diesen Schalter einschalten, wird ein Zugang für DGS-Dolmetschende bereitgestellt. Darüber können Dolmetschende dem Meeting beitreten.',
    'create.textInterpreter.ariaLabel' => 'Zugang für Schriftdolmetschende anlegen',
    'create.textInterpreter.legend' => 'Schrifttdolmetscher*innen',
    'create.textInterpreter.titleText' => 'Schriftdolmetscher*innen',
    'create.textInterpreter.desc' => 'Wenn Sie diesen Schalter einschalten, wird ein Zugang für Schriftdolmetschende bereitgestellt. Darüber können Schriftdolmetscher*innen dem Meeting beitreten.',
    'create.submit' => 'Meeting speichern',
    'create.cancel' => 'abbrechen',

    'mailtemplate.copy' => 'Text der Mailvorlage kopieren',
    'mailtemplate.cancel' => 'Mailvorlage schließen',

    'destroy.modalTitle' => 'Möchten Sie das Meeting entfernen?',
    'destroy.modalDesc' => 'Das Meeting kann nach dem Entfernen nicht mehr durchgeführt werden. Die URL des Meetings steht nach dem Entfernen nicht mehr zur Verfügung. Diese Aktion kann nicht rückgängig gemacht werden.',
    'destroy.submit' => 'ja',
    'destroy.cancel' => 'nein',

    'detail.title.summary' => 'Gespeicherte Angaben',
    'detail.recording.on' => 'Aufzeichnung ist aktiviert',
    'detail.recording.off' => 'Aufzeichnung ist deaktiviert',
    'detail.signLang.on' => 'Zugang für DGS-Dolmetschende ist aktiviert',
    'detail.signLang.off' => 'Zugang für DGS-Dolmetschende ist deaktiviert',
    'detail.textInterpreter.on' => 'Zugang für Schriftdolmetschende ist aktiviert',
    'detail.textInterpreter.off' => 'Zugang für Schriftdolmetschende ist deaktiviert',
    'detail.links.title' => 'Rollenbasierte Zugangs-Links',
    'detail.links.text' => 'Zugang für Moderator*innen',
    'detail.links.desc' => '<p>Ein*e Moderator*in kann:
        <p>
        <ul>
            <li>Das Meeting starten und beenden</li>
            <li>Teilnehmende zu Moderator*in / Co-Moderator*in ernennen</li>
            <li>Teilnehmende entfernen und weitere Teilnehmende einladen</li>
            <li>Teilnehmende stumm schalten / um Lautschalten bitten und das Video anderer Teilnehmender anhalten / um
                Videofreigabe bitten</li>
            <li>Wartende Teilnehmer*innen in das Meeting holen</li>
            <li>Standard-Aktionen ausführen</li>
        </ul>',
    'detail.links.comoderator.text' => 'Zugang für Co-Moderator*innen',
    'detail.links.comoderator.desc' => '<p>Ein*e Co-Moderator*in kann:
        <p>
        <ul>
            <li>Teilnehmende zu Co-Moderator*in ernennen</li>
            <li>Teilnehmenden Aufgaben übergeben</li>
            <li>Teilnehmende entfernen und weitere Teilnehmende einladen</li>
            <li>Teilnehmende stumm schalten / um Lautschalten bitten und das Video anderer Teilnehmender anhalten / um
                Videofreigabe bitten</li>
            <li>Wartende Teilnehmende in das Meeting holen</li>
            <li>Standard-Aktionen ausführen</li>
        </ul>',
    'detail.links.participant.text' => 'Zugang für Teilnehmer*innen',
    'detail.links.participant.desc' => '<p>Ein*e Teilnehmer*in kann:</p>
        <ul>
            <li>als Teilnehmer*in mit aktivem Notfall-Knopf: Teilnehmenden die Aufgabe "Begleitperson" übergeben</li>
            <li>per Telefon teilnehmen</li>
            <li>Standard-Aktionen ausführen</li>
        </ul>',
    'detail.links.assistentSignLang.text' => 'Zugang DGS-Dolmetscher*in',
    'detail.links.assistentSignLang.desc' => '<p>Ein*e DGS-Dolmetscher*in:</p>
        <ul>
            <li>Kann alles, was Teilnehmende können</li>
            <li>Wird für andere Teilnehmer*innen entweder als Kachel oder frei-schwebendes Fenster angezeigt.</li>
        </ul>',
    'detail.links.assistentCaptioner.text' => 'Zugang Schriftdolmetscher*in',
    'detail.links.assistentCaptioner.desc' => '<p>Ein*e Schriftdolmetscher*in kann:</p>
        <ul>
            <li>Kann alles was Teilnehmende können</li>
            <li>Kann bei der Vorbereitung des Meetings einen Lese-Link hinterlegen.</li>
        </ul>',
    'detail.pageTitle' => 'Meeting-Details',
    'detail.close' => 'Zur Liste aller geplanten Meetings',

];
