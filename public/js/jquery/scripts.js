$("#price").ionRangeSlider(
    {
	min: 0,
	max: 100000,
	type: 'double',
	prefix: "₽",
	step: 500,
	grid: true,
	grid_num: 5
    }
);

$("#price_sell").ionRangeSlider(
    {
	min: 0,
	max: 10000,
	type: 'double',
	prefix: "тыс. ₽",
	step: 100,
	grid: true,
	grid_num: 5
    }
);

$("#rooms").ionRangeSlider(
    {
	min: 1,
	max: 5,
	type: 'double',
	grid: true,
	grid_num: 4
    }
);

$("#floors").ionRangeSlider(
    {
	min: 1,
	max: 20,
	type: 'double',
	grid: true,
	grid_num: 10
    }
);

$("#area").ionRangeSlider(
    {
	min: 0,
	max: 500,
	type: 'double',
	grid: true,
	grid_num: 20,
	step: 10,
    }
);