using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class Appointment
    {
        [Key]
        public int AppointmentId { get; set; }
        public Patient Patient { get; set; }
        [ForeignKey("Patient")]
        [Display(Name = "Patient Name")]
        public int PatientId { get; set; }
        public Service Service { get; set; }
        [ForeignKey("Service")]
        [Display(Name = "Service Name")]
        public int ServiceID { get; set; }
        public ApplicationUser Users { get; set; }
        [ForeignKey("Users")]
        [Display(Name = "Doctor Name")]
        public string DoctorId { get; set; }

        [DataType(DataType.Date)]
        [DisplayFormat(ApplyFormatInEditMode = true, DataFormatString = "{0:MM/dd/yyyy}")]
        [Display(Name = "Appointment Date")]
        [Column(TypeName = "date")]
        public DateTime AppointmentDate { get; set; }

        [DataType(DataType.Time)]
        [DisplayFormat(ApplyFormatInEditMode = true, DataFormatString = "{0:HH:mm:ss}")]
        [Display(Name = "Appointment Time")]
        public DateTime AppointmentTime { get; set; }

        [Display(Name = "Appointment Notes")]
        public string AppointmentNotes { get; set; }
        public string DoctorNotes { get; set; }

        public ApplicationUser AddedUser { get; set; }
        [ForeignKey("AddedUser")]
        public string AddedBy { get; set; }

        public DateTime AddedDate { get; set; }

        public bool IsDelete { get; set; }
        public bool IsCancel { get; set; }

        public int RequestAmount { get; set; }

    }
}