using System.ComponentModel.DataAnnotations;

namespace StudentApp.Models
{
public class Student
{
public int Id { get; set; }

[Required, StringLength(100)]
public string FullName { get; set; } = string.Empty;

[EmailAddress, StringLength(100)]
public string? Email { get; set; }

[Range(0,100)]
public int? Grade { get; set; }
}
}