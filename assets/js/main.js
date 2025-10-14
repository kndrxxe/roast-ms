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
    console.log('Monthly sales data:', data); // Debug

    if (!data || !data.length) return;

    const categories = data.map(item => {
      const year = Number(item.year);
      const month = Number(item.month) - 1;
      const date = new Date(year, month);
      return date.toLocaleString('default', { month: 'short', year: 'numeric' });
    });

    const salesData = data.map(item => Number(item.total_sales));

    const options = {
      chart: { height: 350, type: "line" },
      series: [{ name: "Monthly Sales", data: salesData }],
      xaxis: { categories: categories },
      yaxis: { title: { text: "Sales Amount (₱)" } },
      stroke: { width: 4 },
      colors: ["#247BA0"],
      dataLabels: { enabled: false },
      tooltip: {
        shared: true,
        intersect: false,
        y: { formatter: val => "₱" + val.toLocaleString() }
      },
      legend: { horizontalAlign: "left", offsetX: 40 }
    };

    const chartEl = document.querySelector("#charte");
    if (chartEl) {
      new ApexCharts(chartEl, options).render();
    } else {
      console.warn('Chart container "#charte" not found.');
    }
  })
  .catch(err => console.error('Error fetching sales per month:', err));
//-----------------------
// - END Sales per Category CHART -
//----
