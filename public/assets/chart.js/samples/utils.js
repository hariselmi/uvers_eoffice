window.chartColors = {
	violet: 'rgb(119, 128, 138)',
	blue: 'rgb(97, 185, 255)',
	green: 'rgb(0, 164, 137)',
	purple: 'rgb(149, 152, 1)',
};

window.randomScalingFactor = function() {
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
}