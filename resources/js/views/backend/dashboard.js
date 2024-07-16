document.addEventListener('DOMContentLoaded', function () {
    setMeetingProfileStatus();
});

function setMeetingProfileStatus() {
    // if an element with id meetingProfileStatus exists...
    if (document.getElementById('meetingProfileStatus')) {
        // ...try to get the userData from the localStorage
        let userData = JSON.parse(localStorage.getItem('userData'));
        // if userData is not null...
        if (userData) {
            document.getElementById('meetingProfileStatus').innerHTML = 'Sie haben schon Meeting-Einstellungen festgelegt.';
        } else {
            document.getElementById('meetingProfileStatus').innerHTML = 'Sie haben noch keine Meeting-Einstellungen festgelegt.';
        }
    }
}
