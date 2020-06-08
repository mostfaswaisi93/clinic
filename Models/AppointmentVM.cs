using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class ListOfAppointmentVM
    {
        public int AppointmentId { get; set; }
        public string PatientName { get; set; }
        public string ServiceName { get; set; }
        public string DoctorName { get; set; }
        public string AppointmentDate { get; set; }
        public string AppointmentTime { get; set; }
        public string PhoneNumber { get; set; }

        public string AppointmentNotes { get; set; }
    }

    public class AppointmentInfoVM
    {
        public int AppointmentId { get; set; }

        [Display(Name = "Patient Name")]
        public int PatientId { get; set; }

        [Display(Name = "Service Name")]
        public int ServiceID { get; set; }

        [Display(Name = "Doctor Name")]
        public string DoctorId { get; set; }

        [Display(Name = "Appointment Date")]
        public string AppointmentDate { get; set; }

        [Display(Name = "Appointment Time")]
        public string AppointmentTime { get; set; }

        [Display(Name = "Appointment Notes")]
        public string AppointmentNotes { get; set; }

        public string PhoneNumber { get; set; }

        [Display(Name = "المبلغ المستحق لهذه الزيارة")]
        public int RequestAmount { get; set; }

        [Display(Name = "Doctor Notes")]
        public string DoctorNotes { get; set; }

    }

    public class ConfirmAppointmentVM
    {
        public int CAppointID { get; set; }

        [Display(Name = "Request Amount")]
        public int CAppointRequestAmount { get; set; }

        [Display(Name = "Paid Amount")]
        public int CAppointPaidAmount { get; set; }

        [Display(Name = "Note")]
        public string CAppointNotes { get; set; }

    }

    public class SelectDoctorVM
    {
        public string DoctorID { get; set; }
        public string DoctorName { get; set; }
    }
}