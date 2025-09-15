//-----------------------
// - Sales Trends Overtime CHART -
//-----------------------

document.addEventListener("DOMContentLoaded", () => {
  fetch("/roast-ms/pages/admin/api/get_sales_trends.php")
    .then(res => res.json())
    .then(data => {
      if (!data.length) return;

      // Get unique dates in ascending order
      const dates = [...new Set(data.map(d => d.date))].sort();

      // Group data per category
      const categories = {};
      data.forEach(d => {
        if (!categories[d.category]) {
          categories[d.category] = Array(dates.length).fill(0);
        }
        const index = dates.indexOf(d.date);
        categories[d.category][index] = Number(d.total_qty);
      });

      // Build series for ApexCharts
      const series = Object.keys(categories).map(cat => ({
        name: cat,
        data: categories[cat]
      }));

      // Chart options — match your original code
      const sales_chart_options = {
        series: series,
        chart: {
          height: 250,
          type: "area",
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
        legend: { show: false },
        dataLabels: { enabled: false },
        stroke: { curve: "smooth" },
        xaxis: {
          type: "datetime",
          categories: dates, // dynamic dates
        },
        tooltip: {
          x: { format: "MMMM yyyy" }
        },
      };

      // Render chart
      const sales_chart = new ApexCharts(
        document.querySelector("#sales-chart"),
        sales_chart_options
      );
      sales_chart.render();
    })
    .catch(err => console.error("Error fetching sales trends:", err));
});


//---------------------------
// - END Sales Trends Overtime CHART -
//---------------------------

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
