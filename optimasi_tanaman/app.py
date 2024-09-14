from flask import Flask, render_template
import numpy as np
import matplotlib.pyplot as plt
from scipy.optimize import linprog
import io
import base64

app = Flask(__name__)

def solve_optimization():
    # Fungsi tujuan: memaksimalkan Z = 20,000x + 15,000y
    c = [-20000, -15000]

    # Batasan-batasan
    A = [[1, 0.5]]  # batasan untuk lahan
    b = [30]  # lahan maksimum
    A_eq = [[1, 1]]  # batasan jumlah total pohon
    b_eq = [50]  # total 50 pohon
    x_bounds = (0, None)
    y_bounds = (0, None)

    # Menggunakan linprog untuk menyelesaikan masalah ini
    result = linprog(c, A_ub=A, b_ub=b, A_eq=A_eq, b_eq=b_eq, bounds=[x_bounds, y_bounds], method='highs')
    result_x, result_y = result.x

    # Plot grafik
    x_vals = np.linspace(0, 50, 400)
    y_vals_lahan = 2 * (30 - x_vals)
    y_vals_pohon = 50 - x_vals

    plt.figure(figsize=(8, 6))
    plt.plot(x_vals, y_vals_lahan, label="x + 0.5y = 30", color='blue')
    plt.plot(x_vals, y_vals_pohon, label="x + y = 50", color='green')
    plt.fill_between(x_vals, np.minimum(y_vals_lahan, y_vals_pohon), color='gray', alpha=0.3)
    plt.scatter(result_x, result_y, color='red', label=f'Solusi Optimal: ({result_x:.1f}, {result_y:.1f})')

    plt.xlim(0, 50)
    plt.ylim(0, 60)
    plt.xlabel('Jumlah Pohon Jeruk (x)')
    plt.ylabel('Jumlah Pohon Apel (y)')
    plt.title('Grafik Penyelesaian Maksimasi Keuntungan')
    plt.legend()
    plt.grid(True)

    # Simpan plot ke gambar dalam format base64
    img = io.BytesIO()
    plt.savefig(img, format='png')
    img.seek(0)
    plot_url = base64.b64encode(img.getvalue()).decode()

    return result_x, result_y, -result.fun, plot_url

@app.route('/')
def index():
    result_x, result_y, profit, plot_url = solve_optimization()
    return render_template('index.html', result_x=result_x, result_y=result_y, profit=profit, plot_url=plot_url)

if __name__ == '__main__':
    app.run(debug=True)
