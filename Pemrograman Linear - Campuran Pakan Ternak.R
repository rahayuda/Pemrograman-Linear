library(lpSolve)

# Koefisien fungsi objektif (biaya)
obj_coef <- c(10, 8)

# Matriks koefisien batasan (protein dan energi)
# Baris: batasan, Kolom: variabel (Pakan A, Pakan B)
const_matrix <- matrix(c(3, 2,  # Batasan Protein
                         2, 4), # Batasan Energi
                       nrow = 2, byrow = TRUE)

# Vektor nilai batasan (protein, energi)
const_rhs <- c(18, 24)

# Tipe batasan (>=)
const_dir <- c(">=", ">=")

# Solusi dengan menggunakan lpSolve
solution <- lp("min", obj_coef, const_matrix, const_dir, const_rhs)

if (solution$status == 0) {
  pakan_A <- solution$solution[1]
  pakan_B <- solution$solution[2]
  cat("Jumlah Pakan A:", pakan_A, "kg\n")
  cat("Jumlah Pakan B:", pakan_B, "kg\n")
  cat("Biaya Minimal:", solution$objval, "ribu rupiah\n")
} else {
  cat("Tidak dapat menemukan solusi yang memenuhi batasan.\n")
}
