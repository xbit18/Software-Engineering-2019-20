class Presenza{
    constructor(id,entry_date,exit_date,subject,user_id,classroom_id,confirmation,created_at,updated_at){
        this.id = id;
        this.entry_date = entry_date;
        this.exit_date = exit_date;
        this.subject = subject;
        this.user_id = user_id;
        this.confirmation = confirmation;
        this.classroom_id = classroom_id;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default Presenza;