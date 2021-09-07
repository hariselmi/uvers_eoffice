	// Line chart 
	if ($('#line-chart').length) {
		var lineChart = $("#line-chart");
		var lineData = {
			labels: ["10", "20", "30", "40", "50", "60", "70"],
			datasets: [{
				label: "Visitors Graph",
				fill: false,
				lineTension: 0,
				backgroundColor: "#fff",
				borderColor: "#6896f9",
				borderCapStyle: 'butt',
				borderDash: [],
				borderDashOffset: 0.0,
				borderJoinStyle: 'miter',
				pointBorderColor: "#fff",
				pointBackgroundColor: "#2a2f37",
				pointBorderWidth: 3,
				pointHoverRadius: 10,
				pointHoverBackgroundColor: "#FC2055",
				pointHoverBorderColor: "#fff",
				pointHoverBorderWidth: 3,
				pointRadius: 6,
				pointHitRadius: 10,
				data: [5, 32, 5, 42, 50, 59, 11],
				spanGaps: false
			}]
		};

		var myLineChart = new Chart(lineChart, {
			type: 'line',
			data: lineData,
			options: {
				legend: {
					display: false
				},
				scales: {
					xAxes: [{
						ticks: {
							fontSize: '11',
							fontColor: '#969da5'
						},
						gridLines: {
							color: 'rgba(0,0,0,0.05)',
							zeroLineColor: 'rgba(0,0,0,0.05)'
						}
					}],
					yAxes: [{
						display: false,
						ticks: {
							beginAtZero: true,
							max: 65
						}
					}]
				}
			}
		});
	}