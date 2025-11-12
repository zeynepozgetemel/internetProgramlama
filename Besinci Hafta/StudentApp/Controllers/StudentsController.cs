using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using StudentApp.Data;
using StudentApp.Models;

namespace StudentApp.Controllers
{
    public class StudentsController : Controller
    {
        private readonly AppDbContext _db;
        public StudentsController(AppDbContext db) => _db = db;

        // GET: /Students
        public async Task<IActionResult> Index()
        {
            var list = await _db.Students.OrderByDescending(s => s.Id).ToListAsync();
            return View(list);
        }

        // GET: /Students/Create
        public IActionResult Create() => View();

        // POST: /Students/Create
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create(Student model)
        {
            if (!ModelState.IsValid) return View(model);
            _db.Students.Add(model);
            await _db.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        // GET: /Students/Edit/5
        public async Task<IActionResult> Edit(int id)
        {
            var entity = await _db.Students.FindAsync(id);
            if (entity == null) return NotFound();
            return View(entity);
        }

        // POST: /Students/Edit/5
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, Student model)
        {
            if (id != model.Id) return BadRequest();
            if (!ModelState.IsValid) return View(model);

            try
            {
                _db.Update(model);
                await _db.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!await _db.Students.AnyAsync(s => s.Id == id)) return NotFound();
                throw;
            }
        }

        // GET: /Students/Delete/5
        public async Task<IActionResult> Delete(int id)
        {
            var entity = await _db.Students.FirstOrDefaultAsync(s => s.Id == id);
            if (entity == null) return NotFound();
            return View(entity);
        }

        // POST: /Students/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var entity = await _db.Students.FindAsync(id);
            if (entity == null) return NotFound();
            _db.Students.Remove(entity);
            await _db.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        // GET: /Students/Details/5  (opsiyonel)
        public async Task<IActionResult> Details(int id)
        {
            var entity = await _db.Students.FindAsync(id);
            if (entity == null) return NotFound();
            return View(entity);
        }
    }
}
