<?php

return [
    'index.title' => 'Meetings',
    'index.desc' => 'Hier sehen Sie alle Meetings, die Sie geplant haben. Sie können die Details und Einladungslinks hier finden. Außerdem können Sie direkt als Moderator am Meeting teilnehmen. Sie können das Meeting ändern oder löschen.',
    'successTitle' => 'Erfolg!',
    'create.pageTitle' => 'Meeting erstellen',
    'create.pageFormat' => 'h1',
    'create.pageDesc' => "Auf dieser Seite können Sie ein neues Meeting erstellen. Sie müssen einen Titel und einen Start-Zeitpunkt einlegen. Wenn Sie wollen, können Sie auch ein Meeting ohne festen Start-Zeitpunkt erstellen. Dann brauchen Sie keine spezielle Start-Zeit. Außerdem können Sie entscheiden, ob Sie das Meeting aufzeichnen wollen. Und ob Sie Hilfe von Schrift- und/oder DGS-Dolmetschenden möchten.",
    'create.pageHelpLink' => 'javascript:void(0)',
    'create.titleAndDate.ariaLabel' => "Titel und Start-Zeitpunkt festlegen",
    'create.titleAndDate.legend' => "Titel und Start-Zeitpunkt",
    'create.titleAndDate.title.titleText' => "Titel des Meetings",
    'create.titleAndDate.title.desc' => "Diesen Meeting-Titel sehen die Teilnehmer des Meetings. Das ist dann der Name der Veranstaltung.",
    'create.titleAndDate.title.placeholder' => "Bitte geben Sie hier den Meeting-Titel ein",
    'create.titleAndDate.date.headline' => "Datum und Uhrzeit",
    'create.titleAndDate.date.label' => "Datum und Uhrzeit",
    'create.titleAndDate.date.desc' => "Stellen Sie hier bitte einen Tag und eine Uhrzeit ein, an dem das Meeting starten soll. Die Teilnehmer sehen dieses Datum und diese Zeit dann als Start-Zeitpunkt von dem Meeting.",
    'create.recording.legend' => "Meeting-Aufzeichnung",
    'create.recording.titleText' => "Meeting mit Aufzeichnung oder ohne Aufzeichnung?",
    'create.recording.desc' => "Wenn Sie diesen Schalter anschalten, wird das Meeting aufgezeichnet. Jeder Teilnehmer kann sagen, dass er nicht aufgezeichnet werden will: bevor, während oder nach dem Treffen. Dann wird die Aufnahme sofort gelöscht und ist nicht verfügbar. Wenn alle Teilnehmer damit einverstanden sind, können Sie die Aufnahme nach dem Treffen herunterladen. Sie können Sie dann per E-Mail an die Teilnehmer schicken.",
    'create.signLang.ariaLabel' => "Einen Zugang für Gebärdensprach-Dolmetscher erstellen",
    'create.signLang.legend' => "Dolmetschung in Gebärdensprache (DGS)",
    'create.signLang.titleText' => "Dolmetschung in Gebärdensprache (DGS)",
    'create.signLang.desc' => "Wenn Sie diesen Schalter anschalten, dann können Gebärdensprach-Dolmetscher zu dem Meeting dazu kommen.",
    'create.textInterpreter.ariaLabel' => "Einen Zugang für Schriftdolmetscher anlegen",
    'create.textInterpreter.legend' => "Schrifttdolmetscher",
    'create.textInterpreter.titleText' => "Schrifttdolmetscher",
    'create.textInterpreter.desc' => "Wenn Sie diesen Schalter einschalten, können Schriftdolmetscher zu dem Meeting dazu kommen.",
    'create.submit' => "Das Meeting speichern",
    'create.cancel' => 'abbrechen',

    'mailtemplate.copy' => 'Text aus der Mail-Vorlage kopieren',
    'mailtemplate.cancel' => 'Mail-Vorlage schließen',

    'destroy.modalTitle' => "Möchten Sie das Meeting löschen?",
    'destroy.modalDesc' => "Wenn Sie das Meeting löschen, kann es nicht mehr stattfinden. Die Internet-Adresse von dem Meeting gibt es dann nicht mehr. Diese Entscheidung können Sie nicht rückgängig machen.",
    'destroy.submit' => "ja",
    'destroy.cancel' => "nein",

    'detail.title.summary' => "Gespeicherte Angaben",
    'detail.recording.on' => "Aufzeichnung ist möglich",
    'detail.recording.off' => "Aufzeichnung ist nicht möglich",
    'detail.signLang.on' => "Es gibt einen Zugang für Gebärdensprach-Dolmetscher",
    'detail.signLang.off' => "Es gibt keinen Zugang für Gebärdensprach-Dolmetscher",
    'detail.textInterpreter.on' => "Es gibt einen Zugang für Schriftdolmetscher",
    'detail.textInterpreter.off' => "Es gibt keinen Zugang für Schriftdolmerscher",
    'detail.links.title' => "Zugangs-Links je nach Rolle im Meeting",
    'detail.links.text' => "Zugang für Moderatoren",
    'detail.links.desc' => "<p>Ein Moderator kann:
        <p>
        <ul>
            <li>Das Meeting starten und beenden</li>
            <li>Teilnehmer zum Moderator oder zum Co-Moderator machen</li>
            <li>Teilnehmer löschen und mehr Teilnehmer einladen</li>
            <li>Teilnehmer stumm schalten oder um Lautschalten bitten. Das Video von Teilnehmern anhalten oder die Teilnehmer bitten, dass sie ihr Video einschalten.</li>
            <li>Teilnehmer, die warten, in das Meeting holen</li>
            <li>Meeting Standard-Aktionen machen</li>
        </ul>",
    'detail.links.comoderator.text' => "Zugang für Co-Moderatoren",
    'detail.links.comoderator.desc' => "<p>Ein Co-Moderator kann:
        <p>
        <ul>
            <li>Teilnehmer zum Co-Moderator machen</li>
            <li>Teilnehmern Aufgaben geben</li>
            <li>Teilnehmer löschen und mehr Teilnehmer einladen</li>
            <li>Teilnehmer stumm schalten oder um Lautschalten bitten. Das Video von Teilnehmern anhalten oder die Teilnehmer bitten, dass sie ihr Video einschalten.</li>
            <li>Teilnehmer, die warten, in das Meeting holen</li>
            <li>Standard-Aktionen machen</li>
 	</ul>",
    'detail.links.participant.text' => "Zugang für Teilnehmer",
    'detail.links.participant.desc' => "<p>Ein Teilnehmer kann:</p>
	<ul>
            <li>als Teilnehmer mit Notfall-Knopf: Teilnehrn die Aufgabe \"Begleitperson\" geben</li>
            <li>Über das Telefon teilnehmen</li>
            <li>Standard-Aktionen machen</li>
        </ul>",
    'detail.links.assistentSignLang.text' => "Zugang für Gebärdensprach-Dolmetscher",
    'detail.links.assistentSignLang.desc' => "<p>Ein Gebärdensprach-Dolmetscher:</p>
        <ul>
            <li>Kann alles was ein Teilnehmer kann</li>
            <li>Teilnehmer können entscheiden, ob sie den DGS-Dolmetscher im Meeting als Kachel sehen wollen. Oder ob sie ihn als Fenster sehen wollen. Dann können sie den DGS-Dolmetscher frei auf dem Bildschirm verschieben.</li>
        </ul>",
    'detail.links.assistentCaptioner.text' => "Zugang für Schrift-Dolmetscher",
    'detail.links.assistentCaptioner.desc' => "<p>Ein Schrift-Dolmetscher kann:</p>
        <ul>
            <li>Kann alles was ein Teilnehmer kann</li>
            <li>Kann einen Lese-Link angeben, bevor das Meeting losgeht.</li>
        </ul>",
    'detail.pageTitle' => "Meeting-Details",
    'detail.close' => "Hier klicken, um zur Liste aller geplanten Meetings zu kommen",

];
