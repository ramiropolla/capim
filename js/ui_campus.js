/**
 * @constructor
 */
function UI_campus(id)
{
    var self = this;

    var ui_campus = document.getElementById(id).parentNode;
    ui_campus.className = "ui_campus";
    ui_campus.appendChild(document.createTextNode("campus: "));
    var campus = document.createElement("select");
    var option = document.createElement("option");
    option.value = "FLO";
    option.innerHTML = "Florianópolis";
    campus.appendChild(option);
    var option = document.createElement("option");
    option.value = "JOI";
    option.innerHTML = "Joinville";
    campus.appendChild(option);
    ui_campus.appendChild(campus);

    campus.value = "FLO";

    campus.onchange = function() {
        self.cb_campus(this.value);
    }

    var semestre = document.createElement("select");
    var option = document.createElement("option");
    option.value = "20121";
    option.innerHTML = "20121";
    semestre.appendChild(option);
    var option = document.createElement("option");
    option.value = "20122";
    option.innerHTML = "20122";
    semestre.appendChild(option);
    ui_campus.appendChild(semestre);

    semestre.value = "20122";

    semestre.onchange = function() {
        self.cb_semestre(this.value);
    }

    /* callbacks */
    self.cb_campus = null;
    self.cb_semestre = null;
    /* procedures */
    self.set_campus = function(value) { campus.value = value; };
    self.set_semestre = function(value) { semestre.value = value; };
}