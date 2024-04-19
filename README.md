# Laboratorijska Vježba 5 - Napredno web programiranje

## Izrada višejezičnog projekta u Laravel-u

---
### Prije korištenja:
1. **Instaliranje Paketa:**

   * instalirati composer - pratiti upute u installer wizardu

    iza toga u konzoli napisati 
    ```bash
    composer global require laravel/installer
    ```
  ovo je potrebno samo ako vec nemate laravel dostupan na uređaju  
  
### Upute za korištenje:

1. **Klonirajte repozitorij:**

    kloniranje bi bilo pozeljno napravit unutar xampp/htdocs foldera
     ```bash
     git clone https://github.com/Zokky2e/lv3-4-nwp.git
    ```
2. **Migracije**
  
      locirati **preko konzole** mapu Laravel projekta, nalazi se u kloniranom repozitoriju(ime: projects)

      nakon toga pokrenuti migracijsku skriptu

   ```bash
   php artisan migrate


3. **Pokretanje aplikacije**

   kako bi pokrenuli aplikaciju, dovoljno je nakon migracije unijeti komandu
```bash
npm run build
```

  nakon toga otvoriti public folder u browseru, ovim postupkom vaš Laravel projekt mora biti unutar xampp/htdocs foldera

4. **Korištenje aplikacije**
   
   kao **admin** korisnik može dodijeljivati drugim korisnicima role, trenutno samo student i nastavnik
   
   kao **profesor** korisnik može kreirati nove taskove, te naknadno prihvatit studente za te taskove
   
   kao **student** korisnik se može prijaviti na dostupne taskove
