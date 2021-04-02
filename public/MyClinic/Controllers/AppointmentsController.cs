using MyClinic.Models;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web;
using System.Web.Http;
using System.Web.Http.Description;
using System.Web.Mvc;

namespace MyClinic.Controllers
{
    public class AppointmentsController : ApiController
    {
        private ApplicationDbContext db = new ApplicationDbContext();

        // GET: Appointments
        public IQueryable<Appointment> GetAppointments()
        {
            return db.Appointments;
        }

        // GET: api/Appointments/5
        [ResponseType(typeof(Appointment))]
        public IHttpActionResult GetAppointments(int id)
        {
            Appointment appointment = db.Appointments.Find(id);
            if (appointment == null)
            {
                return NotFound();
            }

            return Ok(appointment);
        }

        // PUT: api/Appointments/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutAppointment(int id, Appointment appointment)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != appointment.AppointmentId)
            {
                return BadRequest();
            }

            db.Entry(appointment).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!AppointmentExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/Appointments
        [ResponseType(typeof(Appointment))]
        public IHttpActionResult PostAppointment(Appointment appointment)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.Appointments.Add(appointment);
            db.SaveChanges();

            return CreatedAtRoute("DefaultApi", new { id = appointment.AppointmentId }, appointment);
        }
        public HttpResponseMessage CancelAppointment(int id)
        {
            Appointment appointment = db.Appointments.Find(id);
            if (appointment == null)
                return Request.CreateResponse(HttpStatusCode.NotFound, "الحجز غير موجود");
            try
            {
                if (ModelState.IsValid)
                {
                    appointment.IsCancel = true;
                    db.SaveChanges();
                }

                return Request.CreateResponse(HttpStatusCode.OK, "تم إلغاء الحجز بنجاح");
            }
            catch
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest, "حدث خطأ");
            }
        }

        // DELETE: api/Appointments/5
        public HttpResponseMessage DeleteAppointment(int id)
        {
            Appointment appointment = db.Appointments.Find(id);
            if (appointment == null)
                return Request.CreateResponse(HttpStatusCode.NotFound, "السجل غير موجود");
            try
            {
                db.Appointments.Remove(appointment);
                db.SaveChanges();

                return Request.CreateResponse(HttpStatusCode.OK, "تم حذف السجل بنجاح");
            }
            catch
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest, "حدث خطأ");
            }
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool AppointmentExists(int id)
        {
            return db.Appointments.Count(e => e.AppointmentId == id) > 0;
        }
    }
}