function convert() {
    const value = parseFloat(document.getElementById("value").value);
    const from = document.getElementById("fromUnit").value;
    const to = document.getElementById("toUnit").value;

    const unitsToMeter = {
        km: 1000,
        hm: 100,
        dam: 10,
        m: 1,
        dm: 0.1,
        cm: 0.01,
        mm: 0.001,
        ft: 0.3048
    };

    if (!unitsToMeter[from] || !unitsToMeter[to]) {
        document.getElementById("result").value = "Invalid units";
        return;
    }

    const inMeter = value * unitsToMeter[from];
    const converted = inMeter / unitsToMeter[to];

    const formatted = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 6
    }).format(converted);

    // ✅ tampilkan hasil dulu
    document.getElementById("result").value = formatted + " " + to;

    // ✅ lalu log ke PHP
    fetch("log_handler.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            value: value,
            from: from,
            to: to,
            result: formatted,
            unit: "length"
        })
    })
    .then(res => res.json())
    .then(data => console.log("Log success:", data))
    .catch(err => console.error("Log failed:", err));
}



function convertWeight() {
    const value = parseFloat(document.getElementById("weightValue").value);
    const from = document.getElementById("fromWeight").value;
    const to = document.getElementById("toWeight").value;

    const unitsToGram = {
        kg: 1000,
        hg: 100,
        dag: 10,
        g: 1,
        dg: 0.1,
        cg: 0.01,
        mg: 0.001,
        lb: 453.59237
    };

    if (!unitsToGram[from] || !unitsToGram[to]) {
        document.getElementById("weightResult").value = "Invalid units";
        return;
    }

    const inGram = value * unitsToGram[from];
    const converted = inGram / unitsToGram[to];

    const formatted = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 6
    }).format(converted);

    document.getElementById("weightResult").value = formatted + " " + to;

    fetch("log_handler.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            value: value,
            from: from,
            to: to,
            result: formatted,
            unit: "weight"
        })
    })
    .then(res => res.json())
    .then(data => console.log("Log success:", data))
    .catch(err => console.error("Log failed:", err));
}

// Panjang
document.getElementById("convertForm").addEventListener("submit", function (e) {
    e.preventDefault();
    convert();
});

// Berat
document.getElementById("weightForm").addEventListener("submit", function (e) {
    e.preventDefault();
    convertWeight();
});

document.querySelectorAll(".tabs button").forEach((btn, index) => {
    btn.addEventListener("click", () => {
        // Atur tab aktif
        document.querySelectorAll(".tabs button").forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        // Tampilkan form sesuai tab
        document.getElementById("convertForm").style.display = index === 0 ? "block" : "none";
        document.getElementById("weightForm").style.display = index === 1 ? "block" : "none";
        // Jika ada form temperature/volume, tambahkan index === 2 / 3 juga nanti
    });
});

