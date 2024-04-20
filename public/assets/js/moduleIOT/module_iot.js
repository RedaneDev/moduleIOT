// Récupére le chemin de l'URL vers le backend
const urlPathIndex = document.querySelector('#url_index').getAttribute('data-path');
const urlPathGetData = document.querySelector('#url_get_data').getAttribute('data-path');
const urlPathGenerateData = document.querySelector('#url_generate_data').getAttribute('data-path');
const urlPathResetData = document.querySelector('#url_reset_data').getAttribute('data-path');
const urlPathDeleteType = document.querySelector('#url_delete_type').getAttribute('data-path');
const urlPathDeleteModule = document.querySelector('#url_delete_module').getAttribute('data-path');
let moduleChart;

// Fonction de requête Fetch pour obtenir des données
function getData(moduleId) {
    
    // Efface le graphique précédent
    $("#moduleChart").remove();
    $("#chartWrapper").append('<canvas id="moduleChart"></canvas>');

    // Supprime le dernier caractère dans le chemin de l'URL
    let path = urlPathGetData.slice(0, -1);

    fetch(`${path}${moduleId}`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(response => {

        // Initialiser les variables
        const dateLabels = [];
        const data1 = [];
        const data2 = [];
        const data3 = [];
        const data4 = [];
        const data5 = [];

        // Construis et converti un tableau de données pour chaque ensemble de données
        response.dataModuleIOTs.forEach(element => {
            const m = moment(element.createdAt);
            dateLabels.push(m);
            data1.push(element.data1);
            // Si le module affiche des données
            if(element.data1 == 1) {
                data2.push(element.data2);
                data3.push(element.data3);
                data4.push(element.data4);
                data5.push(element.data5);
            } else {
                data2.push(0);
                data3.push(0);
                data4.push(0);
                data5.push(0);
            }
        });

        // Construis l'objet de jeu de données du graphique
        const datasets = [
            {
                label: response.type.dataName1,
                data: data1,
                borderWidth: 3,
                radius: 0,
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false,
            }, {
                label: response.type.dataName2,
                data: data2,
                borderWidth: 3,
                radius: 0,
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: false
            }, {
                label: response.type.dataName3,
                data: data3,
                borderWidth: 3,
                radius: 0,
                borderColor: 'rgba(75, 255, 192, 1)',
                fill: false,
            }, {
                label: response.type.dataName4,
                data: data4,
                borderWidth: 3,
                radius: 0,
                borderColor: 'rgba(75, 255, 0, 1)',
                fill: false,
            }, {
                label: response.type.dataName5,
                data: data5,
                borderWidth: 3,
                radius: 0,
                borderColor: 'rgba(255, 192, 255, 1)',
                fill: false
            }
        ];

        // Construis l'objet de données du graphique
        const data = {
            labels: dateLabels,
            datasets: datasets
        };

        // Options de zoom pour le graphique
        const zoomOptions = {
            pan: {
                enabled: true,
                mode: 'xy',
            },
            zoom: {
                mode: 'x',
                wheel: {
                    enabled: true
                },
                pinch: {
                    enabled: true
                },
                drag: {
                    enabled: true
                }
            }
        };

        // Options d'échelle pour le graphique
        const scaleOptions = {
            x: {                
                type: 'time',
                parser: 'timeFormat',
                ticks: {
                    autoSkip: true,
                    autoSkipPadding: 50,
                    maxRotation: 0
                },
                time: {
                    tooltipFormat: 'DD-MMM-YYYY HH:mm:ss',
                    displayFormats: {
                        millisecond: 'DD-MMM-YYYY HH:mm:sss',
                        second: 'DD-MMM-YYYY HH:mm:ss',
                        minute:'DD-MMM-YYYY HH:mm',
                        hour:'DD-MMM-YYYY HH:mm',
                        day: 'DD-MMM-YYYY',
                        month: 'MMM-YYYY'
                    }
                },
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Temps'
                },
                grid: {
                    display: false
                }
            },
            y: {
                position: 'right',
                ticks: {
                    callback: (val,index,ticks) => index === 0 || index === ticks.length - 1 ? null : val         
                },
                display: true,
                title: {
                    display: true,
                    text: 'Valeur'
                },
                grid: {
                    display: false
                }
            }
        };

        // Configuration du graphique
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: response.name
                    },
                    legend: true,
                    zoom: zoomOptions,
                },
                interaction: {
                    intersect: false,
                },
                scales: scaleOptions,
            },
        };

        // Initialise le graphique
        moduleChart = new Chart(
            document.getElementById('moduleChart'),
            config
        );

        // Obtiens le nombre de données et le définir dans le panneau d'informations du module
        const data_count = response.dataModuleIOTs.length;
        $('#nbr_data').text(data_count);

        // Le module est-il actif ? Définis les informations dans le panneau du module
        $('#is-active_data').empty();
        if(data1.slice(-1)[0] == 1){
            $('#is-active_data').append('<span class="connected">ok</span>');
        } else {
            $('#is-active_data').append('<span class="disconnected">ko</span>');
        }

        // Calcul de la différence de temps entre la première et la dernière donnée pour le panneau d'informations du module
        const first = dateLabels[0];
        const last = dateLabels.slice(-1)[0];
        
        if(first != undefined && last != undefined){
            let diff = last.diff(first, 'days');

            if(diff == 0) {
                diff = last.diff(first, 'hours');
                if(diff == 0){
                    diff = last.diff(first, 'minutes');
                    if(diff == 0){
                        diff = last.diff(first, 'seconds');
                        if(diff == 0) {
                            diff = last.diff(first);
                            $('#duration_data').text(`${diff} millisecondes`);
                        } else {
                            $('#duration_data').text(`${diff} secondes`);
                        }
                    } else {
                        $('#duration_data').text(`${diff} minutes`);
                    }
                } else {
                    $('#duration_data').text(`${diff} heures`);
                }
            } else {
                $('#duration_data').text(`${diff} jours`);
            }
        }

        // Affiche les informations sur les données
        $('#module_data_info').css('display', 'block');
        $('#chartWrapper').css('display', 'flex');

        // Envoie une notification si le module est déconnecté
        if(data1.slice(-1)[0] == 0){
            new Noty({
                theme: ' alert bg-danger text-white alert-styled-left p-4',
                text: 'Module déconnecté',
                type: 'info',
                progressBar: false,
                layout: 'topRight',
                timeout: 2000
            }).show();
        }

        // Envoye une notification si le module est reconnecté
        if (data1.slice(-2)[0] == 0) {
            if(data1.slice(-1)[0] == 1){
                new Noty({
                    theme: ' alert bg-success text-white alert-styled-left p-4',
                    text: 'Module reconnecté',
                    type: 'info',
                    progressBar: false,
                    layout: 'topRight',
                    timeout: 2000
                }).show();
            }
        }
    })
    .catch(() => {
        // Affiche une notification en cas d'échec de la requête vers la base de données
        new Noty({
            theme: ' alert bg-danger text-white alert-styled-left p-4',
            text: 'La requête en base de données a échoué, veuillez contacter l\'administrateur',
            type: 'info',
            progressBar: false,
            layout: 'topRight',
            timeout: 3000
        }).show();
    });
}

// Fonction de requête Fetch pour générer et obtenir des données
function generateData() {
    const moduleId = $('.module_selector').val();
    let path = urlPathGenerateData.slice(0, -1);

    fetch(`${path}${moduleId}`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(response => {
        const m = moment(response.createdAt);
        moduleChart.data.labels.push(m);
        moduleChart.data.datasets[0].data.push(response.data1);

        if(response.data1 == 1) {
            moduleChart.data.datasets[1].data.push(response.data2);
            moduleChart.data.datasets[2].data.push(response.data3);
            moduleChart.data.datasets[3].data.push(response.data4);
            moduleChart.data.datasets[4].data.push(response.data5);
        } else {
            moduleChart.data.datasets[1].data.push(0);
            moduleChart.data.datasets[2].data.push(0);
            moduleChart.data.datasets[3].data.push(0);
            moduleChart.data.datasets[4].data.push(0);            
        }

        $('#nbr_data').text(moduleChart.data.labels.length);

        $('#is-active_data').empty();
        if(moduleChart.data.datasets[0].data.slice(-1)[0] == 1){
            $('#is-active_data').append('<span class="connected">ok</span>');
        } else {
            $('#is-active_data').append('<span class="disconnected">ko</span>');
        }

        const first = moduleChart.data.labels[0];
        const last = moduleChart.data.labels.slice(-1)[0];
        if(first != undefined && last != undefined){
            let diff = last.diff(first, 'days');
            if(diff == 0) {
                diff = last.diff(first, 'hours');
                if(diff == 0){
                    diff = last.diff(first, 'minutes');
                    if(diff == 0){
                        diff = last.diff(first, 'seconds');
                        if(diff == 0) {
                            diff = last.diff(first);
                            $('#duration_data').text(`${diff} millisecondes`);
                        } else {
                            $('#duration_data').text(`${diff} secondes`);
                        }
                    } else {
                        $('#duration_data').text(`${diff} minutes`);
                    }
                } else {
                    $('#duration_data').text(`${diff} heures`);
                }
            } else {
                $('#duration_data').text(`${diff} jours`);
            }
        }

        if(response.data1 == 0){
            new Noty({
                theme: ' alert bg-danger text-white alert-styled-left p-4',
                text: 'Module déconnecté',
                type: 'info',
                progressBar: false,
                layout: 'topRight',
                timeout: 2000
            }).show();
        }

        if (moduleChart.data.datasets[0].data[moduleChart.data.datasets[0].data.length - 2] == 0) {
            if(response.data1 == 1){
                new Noty({
                    theme: ' alert bg-success text-white alert-styled-left p-4',
                    text: 'Module reconnecté',
                    type: 'info',
                    progressBar: false,
                    layout: 'topRight',
                    timeout: 2000
                }).show();
            }
        }

        moduleChart.update();
    })
    .catch(() => {
        new Noty({
            theme: ' alert bg-danger text-white alert-styled-left p-4',
            text: 'La requête en base de données a échoué, veuillez contacter l\'administrateur',
            type: 'info',
            progressBar: false,
            layout: 'topRight',
            timeout: 3000
        }).show();
    });
}

// Fonction de requête Fetch pour réinitialiser les données
function resetData() {
    const moduleId = $('.module_selector').val();
    let path = urlPathResetData.slice(0, -1);

    fetch(`${path}${moduleId}`, {
        method: 'GET'
    })
    .then(() => {
        getData(moduleId);
        moduleChart.update();
        new Noty({
            theme: ' alert bg-success text-white alert-styled-left p-4',
            text: 'Les données pour ce module ont été effacées de la base de données',
            type: 'info',
            progressBar: false,
            layout: 'topRight',
            timeout: 3000
        }).show();
    })
    .catch(() => {
        new Noty({
            theme: ' alert bg-danger text-white alert-styled-left p-4',
            text: 'La requête en base de données a échoué, veuillez contacter l\'administrateur',
            type: 'info',
            progressBar: false,
            layout: 'topRight',
            timeout: 3000
        }).show();
    });
}

function deleteModule() {
    let path = urlPathDeleteModule.slice(0, -1);
    const moduleId = $('.module_selector').val();

    fetch(`${path}${moduleId}`, {
        method: 'DELETE'
    })
    .then(() => {
        window.location.href = urlPathIndex; 
    });
}

function deleteType() {
    let path = urlPathDeleteType.slice(0, -1);
    const moduleId = $('.module_selector').val();

    fetch(`${path}${moduleId}`, {
        method: 'DELETE'
    })
    .then(() => {
        window.location.href = urlPathIndex; 
    });
}

$(document).ready(function() {
    // Initialise select2
    $('.select2').select2();

    // Initialise la variable d'intervalle pour accéder à la portée
    let createData;

    // Sélectionne le module
    $('.module_selector').on('change', function() {

        // Affiche le bouton de suppression
        $('.delete-module').css('display', 'flex');
        $('.delete-type').css('display', 'flex');
        
        // Obtenir l'ID du module
        let id = $(this).val();

        // Arrêter la création de données
        if($('#toggle-event').prop('checked') == true){
            $('#toggle-event').bootstrapToggle('off');
            clearInterval(createData);
        }

        // Obtenir les données du module sélectionné
        getData(id);
    });

    // Basculer la création de données
    $('#toggle-event').change(function() {
        if($(this).prop('checked') == true){
            createData = setInterval(() => {
                generateData();
            }, 1000);
        } else {
            clearInterval(createData);
        }
    });
});
