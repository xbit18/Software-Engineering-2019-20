class Prenotazione{
    constructor(id,stato,data_inizio,data_fine,motivazione,id_aula,id_utente,created_at,updated_at){
        this.id = id;
        this.stato = stato;
        this.data_inizio = data_inizio;
        this.data_fine = data_fine;
        this.motivazione = motivazione;
        this.id_aula = id_aula;
        this.id_utente = id_utente;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default Prenotazione;