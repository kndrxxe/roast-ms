//-----------------------
// - Sales Distribution CHART -
//-----------------------

fetch("/roast-ms/pages/admin/api/get_salesdistribution.php")
  .then((res) => res.json())
  .then((data) => {
    const sales_distribution_options = {
      series: data.series,
      chart: {
        height: 285,
        type: "donut",
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
            reset: '<img src="/static/icons/reset.png" width="20">',
            customIcons: [],
          },
        },
      },
      labels: data.labels,
      legend: { show: false },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " pieces";
          },
        },
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              name: {
                show: true,
                fontSize: "15px",
                fontWeight: 600,
              },
              value: {
                show: true,
                fontSize: "15px",
                fontWeight: 400,
                formatter: function (val) {
                  return val; // ✅ raw value only
                },
              },
              total: {
                show: true,
                fontSize: "15px",
                fontWeight: 600,
                color: "#373d3f",
              },
            },
          },
        },
      },
      dataLabels: { enabled: true },
    };

    const sales_distribution = new ApexCharts(
      document.querySelector("#sales-distribution"),
      sales_distribution_options
    );
    sales_distribution.render();
  });

//---------------------------
// - END Sales Distribution CHART -
//---------------------------

//-----------------------
// - Sales per Category CHART -
//-----------------------
fetch("/roast-ms/pages/admin/api/get_sales_per_category.php")
  .then((res) => res.json())
  .then((data) => {
    const topbar_options = {
      chart: {
        height: 250,
        type: "bar",
        toolbar: { show: true },
      },
      theme: { palette: "palette1" },
      plotOptions: {
        bar: {
          horizontal: false,
          distributed: true,
        },
      },
      legend: { show: false },
      dataLabels: { enabled: true },
      series: [
        {
          name: "Sales",
          data: data, // ✅ {x: "Fruits", y: 65}
        },
      ],
    };

    const topbar_chart = new ApexCharts(
      document.querySelector("#top-chart"),
      topbar_options
    );
    topbar_chart.render();
  });

//-----------------------
// - END Sales per Category CHART -
//-----------------------

//-----------------------
// - Sales per Month CHART -
//-----------------------
fetch('/roast-ms/pages/admin/api/get_sales_per_month.php')
  .then(res => res.json())
  .then(data => {

    if (!data || !data.length) {
      console.warn('No sales data available');
      return;
    }

    // ----------------------------
    // PREPARE DATA
    // ----------------------------
    const categories = [];
    const salesData = [];

    data.forEach(item => {
      const date = new Date(item.year, item.month - 1);
      categories.push(
        date.toLocaleString('default', { month: 'short', year: 'numeric' })
      );
      salesData.push(Number(item.total_sales));
    });

    // ----------------------------
    // WEIGHTED MOVING AVERAGE
    // ----------------------------
    function weightedMovingAverage(data, weights = [0.2, 0.3, 0.5]) {
      if (data.length < weights.length) return data[data.length - 1];

      return weights.reduce((sum, weight, i) => {
        return sum + data[data.length - weights.length + i] * weight;
      }, 0);
    }

    // ----------------------------
    // TREND CALCULATION
    // ----------------------------
    function calculateTrend(data) {
      if (data.length < 2) return 0;
      return data[data.length - 1] - data[data.length - 2];
    }

    // ----------------------------
    // PREDICTIVE MODEL
    // ----------------------------
    function predictSales(data, months = 6) {
      const predictions = [];
      let tempData = [...data];

      for (let i = 0; i < months; i++) {
        const base = weightedMovingAverage(tempData);
        const trend = calculateTrend(tempData);
        const next = Math.max(0, Math.round(base + trend * 0.6));

        predictions.push(next);
        tempData.push(next);
      }
      return predictions;
    }

    const forecastMonths = 6;
    const forecastData = predictSales(salesData, forecastMonths);

    // ----------------------------
    // ADD FUTURE MONTH LABELS
    // ----------------------------
    const lastDate = new Date(
      data[data.length - 1].year,
      data[data.length - 1].month - 1
    );

    for (let i = 1; i <= forecastMonths; i++) {
      const next = new Date(lastDate);
      next.setMonth(lastDate.getMonth() + i);
      categories.push(
        next.toLocaleString('default', { month: 'short', year: 'numeric' })
      );
    }

    // ----------------------------
    // APEXCHARTS CONFIG
    // ----------------------------
    const options = {
      chart: {
        height: 350,
        type: "line",
        toolbar: { show: true }
      },
      series: [
        {
          name: "Actual Sales",
          data: salesData.concat(Array(forecastMonths).fill(null))
        },
        {
          name: "Predicted Sales",
          data: Array(salesData.length).fill(null).concat(forecastData)
        }
      ],
      xaxis: {
        categories
      },
      yaxis: {
        title: {
          text: "Sales Amount (₱)"
        }
      },
      stroke: {
        width: 4,
        dashArray: [0, 6]
      },
      colors: ["#247BA0", "#F6AE2D"],
      dataLabels: {
        enabled: false
      },
      tooltip: {
        shared: true,
        y: {
          formatter: val => val ? "₱" + val.toLocaleString() : ""
        }
      },
      legend: {
        position: "top",
        horizontalAlign: "left"
      }
    };

    // ----------------------------
    // RENDER CHART
    // ----------------------------
    const chartEl = document.querySelector("#charte");
    if (chartEl) {
      new ApexCharts(chartEl, options).render();
    } else {
      console.error('Chart container #charte not found');
    }

  })
  .catch(err => console.error('Sales prediction error:', err));
//-----------------------
// - END Sales per Month CHART -
//----
