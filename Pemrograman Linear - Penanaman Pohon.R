library(lpSolve)

Keputusan <- c(20, 15)
A <- matrix(c(1, 0.5, 1, 1), nrow=2, byrow=TRUE)
B <- c(30, 50)
arah <- c("<=","<=")

optimal <- lp(direction = "max",
              objective.in = Keputusan,
              const.mat = A,
              const.dir = arah,
              const.rhs = B,
              all.int = T)

str(optimal)

solusiterbaik <- optimal$solution

solusiterbaik

names(solusiterbaik) <- c("Pohon Jeruk", "Pohon Apel")

print(solusiterbaik)

print(paste("Pendapatan maksimal yang didapatkan: ",optimal$objval,sep=""))

