//-----------------------
// - Sales Trends CHART -
//-----------------------

const sales_chart_options = {
  series: [
    {
      name: "Digital Goods",
      data: [28, 48, 40, 19, 86, 27, 90],
    },
    {
      name: "Electronics",
      data: [65, 59, 80, 81, 56, 55, 40],
    },
    {
      name: "Food",
      data: [65, 59, 80, 81, 56, 55, 40],
    },
  ],
  chart: {
    height: 250,
    type: "area",
    distributed: true,
    toolbar: {
      show: true,
      tools: {
        download: true,
        selection: true,
        zoom: false,
        zoomin: true,
        zoomout: true,
        pan: false,
        reset: false | '<img src="/static/icons/reset.png" width="20">',
        customIcons: [],
      },
    },
  },
  legend: {
    show: false,
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: "smooth",
  },
  xaxis: {
    type: "datetime",
    categories: [
      "2023-01-01",
      "2023-02-01",
      "2023-03-01",
      "2023-04-01",
      "2023-05-01",
      "2023-06-01",
      "2023-07-01",
    ],
  },
  tooltip: {
    x: {
      format: "MMMM yyyy",
    },
  },
};

const sales_chart = new ApexCharts(
  document.querySelector("#sales-chart"),
  sales_chart_options
);
sales_chart.render();

//---------------------------
// - END TREND SALES CHART -
//---------------------------

//-----------------------
// - Top Sales CHART -
//-----------------------
const topbar_options = {
  chart: {
    height: 250,
    type: "bar",
    toolbar: {
      show: true,
    },
  },
  theme: {
    palette: "palette1", // upto palette10
  },
  plotOptions: {
    bar: {
      horizontal: false,
      distributed: true,
    },
  },
  legend: {
    show: false,
  },
  dataLabels: {
    enabled: true,
  },
  series: [
    {
      data: [
        {
          x: "category A",
          y: 10,
        },
        {
          x: "category B",
          y: 18,
        },
        {
          x: "category C",
          y: 13,
        },
        {
          x: "category D",
          y: 25,
        },
      ],
    },
  ],
};

const topbar_chart = new ApexCharts(
  document.querySelector("#top-chart"),
  topbar_options
);
topbar_chart.render();

//-----------------------
// - END Top Sales CHART -
//-----------------------
